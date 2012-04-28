<?php

/* * ***** ****** ****** ****** ****** ******
 *
 * Author       :   Shafiul Azam
 *              :   ishafiul@gmail.com
 *              :   Project Manager
 * Page         :
 * Description  :   
 * Last Updated :
 *
 * ****** ****** ****** ****** ****** ***** */



    class Fields extends CI_Controller{
        
        
        public $defaultBreadCrumb;
        
        function __construct(){
            parent::__construct();
            $this->defaultBreadcrumb = array(
            "Home" => base_url(),
            "Fields" => site_url("fields"));
            // Load User Model
            $this->load->model('model_user','User');
            $this->load->model('Field');
            $this->load->model('User_field');
        }
        
        
        // Validation Functions
        function validate_availability(){
           // In case of global, name must be unique
           // in case of those under Institutions, only one name under an institute. 
           return $this->Field->IsAvailable();
        }
        
        function validate_referer(){
            $ref = $this->input->post('referer');
            if(!empty($ref)){
                if( $this->User->IsUsernameValid($ref) ){
                    // Now validate whether this user has permission to this Field.
                    $this->User_field->username = $ref;
                    $this->User_field->field_id = $this->input->post('id');
                    if (!$this->User_field->ValidateMembership() ){
                        $this->form_validation->set_message('validate_referer', 'This Username you chose is not a member of this field!');
                        return false;
                    }else{
                        return true;
                    }
                }
                $this->form_validation->set_message('validate_referer', 'This Referer username is invalid!');
                return false;
            }
            return true;    //  no referer choosen.
        }
        
        function validate_institute_membership(){
            // checks if the user has access to that institute
            $username = $this->User->Authenticate();
            $fieldId = $this->input->post('id');
            // get institution id of this field
            $this->Field->field_id = $fieldId;
            $instId = $this->Field->GetInstitute_id();
            if($instId == 0)
                return true;
            $this->load->model('User_inst');
            $this->User_inst->username = $username;
            $this->User_inst->institution_id = $instId;
            return $this->User_inst->ValidateMembership();
        }
        
        
        function index(){
            // view public fields here.
            redirect('fields/join');
        }
        
        
        function create($mode="", $option = ""){

           $this->page->title = "Create New Field";
           $this->defaultBreadcrumb['Create New Field'] = "";
           $this->page->breadcrumbs = $this->defaultBreadcrumb;
           $uname = $this->User->Authenticate();
           if(!$uname)
               return;
           if(!empty ($mode)){
               if($mode == "process"){
                   // Process Submitted request
                   if($option == "modify")
                       $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');
                   else
                       $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]|callback_validate_availability');
                  
                   $this->form_validation->set_rules('short_name', 'Short Name', 'required|max_length[100]');
                   $this->form_validation->set_rules('institution_id', 'Institution ID', 'required|integer');
                   
                   // Prepare the model
                   $this->Field->name = $this->input->post('name');
                   $this->Field->short_name = $this->input->post('short_name');
                   $this->Field->institution_id = (int) ($this->input->post('institution_id') );
                   
                   $this->form_validation->set_rules('short_description', 'Short Description', 'required|max_length[500]');
                   $this->form_validation->set_message('validate_availability', 'This Name is Unavailable!');
                   if($option == "modify"){
                       $this->form_validation->set_rules('field_id','Field Id', 'required|integer');
                       $this->form_validation->set_rules('status','Status ', 'required');
                   }
                   if($this->form_validation->run()){
                       // Success. insert into db
                       if($option == "modify"){
                           // validate permissions
                           
                           if(! $this->User->AuthenticateAsAdmin(false))
                            return;
                           
                           $this->Field->field_id = $this->input->post('field_id');
                           if(!$this->Field->Load()){
                               $this->page->showMessage("The Field was not found for modifying");
                               return;
                           }
                       }
                       $this->Field->short_description = $this->input->post('short_description');
                       
                       if($option == "modify"){
                           $this->Field->status = $this->input->post('status');
                           $this->Field->Update();
                           $this->page->showMessage("Field Updated!");
                           return;
                       }
                       $this->Field->status = "pending";
                       // Get a community
                       $this->load->model("model_community","Community");
                       // Create Instance
                       $this->Community->name = "Community for " . $this->Field->name;
                       $this->Community->type = "field";
                       $this->Community->short_description = $this->Field->short_description;
                       $this->Community->DirectInsert();  //  Created

                       
                       
                       if(!$this->Community->community_id){
                           $this->page->showMesssage("Failed to create community!");
                           return;
                       }
                       
                       $this->Field->community_id = $this->Community->community_id;
                       
                       $this->Field->Insert();    //  Insert Into DB
                       if($this->Field->field_id){
                           // Insert it into user_field
                           // Prepare Object
                           $this->User_field->username = $uname;
                           $this->User_field->field_id = $this->Field->field_id;
                           $this->User_field->role = "owner";
                           $this->User_field->Insert();  // Create
                           $this->page->showMessage("Successfully created Field! ID is: " . $this->Field->field_id);
                       }else{
                           $this->page->showMessage("Error! Instituion name/short name alredy taken.");
                       }
                       return;
                   }else{
                       // Not validated
                       if($option == "modify"){
//                           echo validation_errors();
//                           die();
                           redirect('fields/modify/id_chosen/' . $this->input->post('field_id'));
                           return;
                       }
                   }
               }
           }
           
           // Get all institution list to send to sidebars
           
           $this->load->model('Institution');
           $institutes = $this->Institution->GetAll();
           // Prepare data to send
           $data = array();
           $data['0'] = "Under No Institution (Global)";
           foreach($institutes as $i){
               $data[$i->institution_id] = $i->name;
           }

           $this->page->loadViews(
                   array(
                       array("Fields", "sidebars/field_common"),
                       array("Administration", "sidebars/field_admin")
                   ),
                   array(
                       array("Create New Field", "forms/createField", array("institutes" => $data))
                   ),
                   null);
       }
       
       
       function join($mode = "", $id = ""){
           // Join an Institution
           
           
           $this->load->model('User_field');
           
           $this->page->title = "Join A Field";
           $this->defaultBreadcrumb['Join A Field'] = "";
           $this->page->breadcrumbs = $this->defaultBreadcrumb;
           $uname = $this->User->Authenticate();
           if(!$uname)
               return;

           if(!empty($mode)){
               if($mode == "id_chosen"){
                   if(!isset($id)){
                       $this->page->showMessage("Error: Must Choose A Field First!");
                       return;
                   }

               }else if($mode == "ref_chosen"){
                   $this->form_validation->set_rules('id', 'Field ID', 'required|callback_validate_institute_membership');
                   $this->form_validation->set_rules('referer', 'Referer Username', 'max_length[20]|callback_validate_referer');

                   $this->form_validation->set_message('validate_institute_membership', 'You do not have access to this the institution of this Field!');
             
                   if($this->form_validation->run()){
                       // success! Check if Field exists
                       $id = $this->input->post('id');
    //                   $this->load->model('Institution');
                       $this->Field->field_id = $id;
                       if(!$this->Field->Load()){
                           $this->page->showMessage("Field ID " . $this->Field->field_id . " was not found!");
                           return;
                       }
                       if($this->Field->status != "approved"){
                           $this->page->showMessage("This Field is not approved yet.");
                           return;
                       }
                       // Future implementation: check if the referer valid
                       $this->User_field->username = $uname;
                       $this->User_field->field_id = $id;
                       $this->User_field->referer = $this->input->post('referer');
                       $this->User_field->role = "pending";
                       if($this->User_field->IsAvailable()){
                           $this->User_field->Insert();
                           $this->page->showMessage("You are successfully applied for the Field.");
                       }else{
                           $this->page->showMessage("You have already applied for the field!");
                       }
                       return;
                   }
               }
               $this->defaultBreadcrumb['Join A Field'] = site_url('fields/join');
               $this->defaultBreadcrumb['Choose Referer'] = "";
               $this->page->breadcrumbs = $this->defaultBreadcrumb;
               $this->page->loadViews(
                    array(
                       array("Fields", "sidebars/field_common"),
                       array("Administration", "sidebars/field_admin")
                    ),
                    array(
                       array("Choose A Referer", "forms/choose_referer", array("id" => $id, "controller" => "fields")),
                    ),
                    null);
               return;
           }

           // Load  Models
           $fieldList = $this->Field->GetAllApproved();
           
           // Get referer requests
           $refData = $this->User_field->GetRefererRequests($uname);

           $this->page->loadViews(
                array(
                   array("Fields", "sidebars/field_common"),
                   array("Administration", "sidebars/field_admin")
                ),
                array(
                   array("Join A Field", "field/listAll", array("list" => $fieldList)),
                ),
                array(
                    array("Requests", "sidebars/referer_requests", array("fieldData" => $refData))
                ));
       }
       
       function modify($mode = "", $id = "") {
            // Modify an Institution
            $this->page->title = "Modify A Field";
            $this->defaultBreadcrumb['Modify A Field'] = "";
            $this->page->breadcrumbs = $this->defaultBreadcrumb;
            $uname = $this->User->Authenticate();
            if (!$uname)
                return;
            
            if(! $this->User->AuthenticateAsAdmin(false))
                return;
            
            if (!empty($mode)) {
                if ($mode == "id_chosen") {
                    if (empty($id)) {
                        $this->page->showMessage("Error: Must Choose An ID");
                        return;
                    }
                    // Check permission here. dummy validated...
                    // get the institution
    //               $this->load->model('Institution');

                    $this->Field->field_id = $id;


                    if (!$this->Field->Load()) {
                        $this->page->showMessage("Could not load Field " . $this->Field->field_id);
                        return;
                    }
                    
                    
                    // Get all institution list to send to sidebars
           
                    $this->load->model('Institution');
                    $institutes = $this->Institution->GetAll();
                    // Prepare data to send
                    $data = array();
                    $data['0'] = "Under No Institution (Global)";
                    foreach($institutes as $i){
                       $data[$i->institution_id] = $i->name;
                    }
                    

                    // All Validated. do something here.
                    $this->defaultBreadcrumb['Modify A Field'] = site_url('fields/modify');
                    $this->defaultBreadcrumb['Edit'] = "";
                    $this->page->breadcrumbs = $this->defaultBreadcrumb;
                    $this->page->loadViews(
                            array(
                        array("Fields", "sidebars/field_common"),
                        array("Administration", "sidebars/field_admin")
                            ), array(
                        array("Edit Field", "forms/modifyField", array("fieldData" => $this->Field, "instList" => $data)),
                            ), null);
                    return;
                }
            }

            // Load  Models
    //       $this->load->model('Institution');
            $fieldList = $this->Field->GetAll();

            $this->page->loadViews(
                    array(
                array("Fields", "sidebars/field_common"),
                array("Administration", "sidebars/field_admin")
                    ), array(
                array("Modify A Field", "field/listAll", array("list" => $fieldList, "action" => "modify")),
                    ), null);
        }
        
        
        function view($field_id, $option="") {

            // validations not required since this is general view
            $this->Field->field_id = $field_id;
            if (!$this->Field->Load()) {
                $this->page->showMessage("The Field you specified was not found");
                return;
            }



            if ($option == "community") {
                // Load this page's community. Here we may need validation if the user joined this community
                redirect('community/index/' . $this->Field->community_id);
                return;
            }
            
            // Get Events
            $this->load->model('model_event','Event');
            $eventsArr = $this->Event->GetByCommunityId($this->Field->community_id);

            // Get News
            $this->load->model('model_news','News');
            $newsArr = $this->News->GetByCommunityId($this->Field->community_id);

            $this->defaultBreadcrumb[$this->Field->short_name] = "";
            $this->page->breadcrumbs = $this->defaultBreadcrumb;
            $this->page->title = $this->Field->name . " | Field";

            $this->page->loadViews(
                    null, array(
                array($this->Field->name, "field/view", array(
                    "fieldData" => $this->Field,
                    "eventsData" => $eventsArr,
                    "newsData" => $newsArr)
                    )
                    ), null);
        }
        
        function pendingMembers($mode, $id, $chosenUsername = "", $status = "member") {
            // Approve pending Members
            $this->page->title = "Pending Membership Approval";
            $this->defaultBreadcrumb['Pending Membership'] = "";
            $this->page->breadcrumbs = $this->defaultBreadcrumb;
            $uname = $this->User->Authenticate();

            if(!$uname)
                return;

            // validate if the user is really member of this community

            $this->load->model('User_field');

            if(! $this->User->AuthenticateAsAdmin()){
                $this->User_field->field_id = $id;
                $this->User_field->username = $uname;
                if(!$this->User_field->ValidateMembership()){
                    $this->page->showMessage("You are not a member of this Field!");
                    return;
                }
            }else{
    //            die("Admin!!");
            }

            // validate Institution

            $this->Field->field_id = $id;
            if(! $this->Field->Load()){
                $this->page->showMessage("Invalid Field ID");
                return;
            }

            switch ($mode){
                case 'list':

                    $data = $this->User_field->GetPendingMembers($id);

                    break;

                case 'approve':

                    if(empty($chosenUsername)){
                        $this->page->showMessage("No Username Chosen");
                        return;
                    }

                    $statusArr = array("member", "banned");
                    if(!in_array($status, $statusArr)){
                        $this->page->showMessage("Fatal error: invalid status");
                        return;
                    }

                    // Try to update

                    $this->User_field->field_id = $id;
                    $this->User_field->username = $chosenUsername;

                    if(!$this->User_field->Load()){
                        $this->page->showMessage("Invalid username/field ID");
                        return;
                    }

                    $this->User_field->referer = $uname;
                    $this->User_field->role = $status;
                    $this->User_field->Update();

                    // fetch comm id
                    if($status == "member"){
                        $this->Field->field_id = $id;
                        $this->Field->Load();
                        $this->load->model('User_community');
                        $this->User_community->Insert($chosenUsername, $this->Field->community_id);
                    }

                    $this->page->showMessage("Updated Successfully!");
                    return;

                    break;
                default:
                    //nothings
            }

            $this->page->loadViews(
                            array(
                        array("Fields", "sidebars/field_common"),
                        array("Administration", "sidebars/field_admin")
                            ), array(
                        array("Approve Pending Membership", "field/listPendingMembers", array(
                            "data" => $data, "fieldId" => $id
                            )),
                            ), null);
        }
        
    }

?>
