<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Institute extends CI_Controller {

    public $defaultBreadcrumb;

    //put your code here

    function __construct() {
        parent::__construct();
        $this->defaultBreadcrumb = array(
            "Home" => base_url(),
            "Institution" => site_url("institute"));
        // Load User Model
        $this->load->model('model_user', 'User');
        $this->load->model('Institution');
    }

    // Validation Functions
    function validate_availability() {

        return $this->Institution->IsAvailable();
    }

    function validate_referer() {
        $ref = $this->input->post('referer');
        if (!empty($ref)) {
            if ($this->User->IsUsernameValid($ref) ){
                $this->load->model('User_inst');
                $this->User_inst->username = $ref;
                $this->User_inst->institution_id = $this->input->post('id');
                if (!$this->User_inst->ValidateMembership()){
                    return false;
                }else{
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    // View Creators
    function index() {
        redirect('institute/join');
    }

    function create($mode="", $option = "") {

        $this->page->title = "Create New Institution";
        $this->defaultBreadcrumb['Create New Instituion'] = "";
        $this->page->breadcrumbs = $this->defaultBreadcrumb;
        $uname = $this->User->Authenticate();
        if (!$uname)
            return;
        if (!empty($mode)) {
            if ($mode == "process") {



                // Process Submitted request
                
                $this->form_validation->set_rules('sname', 'Short Name', 'required|max_length[100]');

                $this->Institution->name = $this->input->post('name');
                $this->Institution->short_name = $this->input->post('sname');


                $this->form_validation->set_rules('location', 'Location', 'required|max_length[100]');
                $this->form_validation->set_rules('campuses', 'Campuses', 'required|max_length[500]');
                $this->form_validation->set_rules('short_description', 'Short Description', 'required|max_length[500]');
                $this->form_validation->set_message('validate_availability', 'This Name or Short Name is Unavailable!');
                if ($option == "modify") {
                    $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');
                    $this->form_validation->set_rules('institution_id', 'Institution Id', 'required');
                    $this->form_validation->set_rules('status', 'Status ', 'required');
                }else{
                    $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]|callback_validate_availability');
                }
                if ($this->form_validation->run()) {
                    // Success. insert into db
//                   $this->load->model('Institution');
                    // Create Object
                    if ($option == "modify") {
                        // validate permissions
                        
                        if(! $this->User->AuthenticateAsAdmin(false))
                            return;
                        
                        $this->Institution->institution_id = $this->input->post('institution_id');
                        if (!$this->Institution->Load()) {
                            $this->page->showMessage("The institution was not found for modifying");
                            return;
                        }
                    }

                    $this->Institution->campuses = $this->input->post('campuses');
                    $this->Institution->short_description = $this->input->post('short_description');
                    $this->Institution->location = $this->input->post('location');
                    if ($option == "modify") {
//                        die("Im hre");
                        $this->Institution->status = $this->input->post('status');
                        $this->Institution->Update();
                        $this->page->showMessage("Institution Updated!");
                        return;
                    }
                    $this->Institution->status = "pending";

                    // Get a community
                    $this->load->model("model_community", "Community");
                    // Create Instance
                    $this->Community->name = "Community for " . $this->Institution->name;
                    $this->Community->type = "institution";
                    $this->Community->short_description = $this->Institution->short_description;
                    $this->Community->DirectInsert();  //  Created

                    

                    if (!$this->Community->community_id) {
                        $this->page->showMesssage("Failed to create community!");
                        return;
                    }

                    $this->Institution->community_id = $this->Community->community_id;
                    // Done. Now INSERT
                    $this->Institution->Insert();    //  Insert Into DB
                    if ($this->Institution->institution_id) {
                        // Insert it into user_inst
                        $this->load->model('User_inst');
                        // Prepare Object
                        $this->User_inst->username = $uname;
                        $this->User_inst->institution_id = $this->Institution->institution_id;
                        $this->User_inst->role = "owner";
                        $this->User_inst->Insert();  // Create

                        $this->page->showMessage("Successfully created Institution! ID is: " . $this->Institution->institution_id);
                    } else {
                        $this->page->showMessage("Error! Instituion name/short name alredy taken.");
                    }
                    return;
                } else {
                    // Not validated
                    echo validation_errors();
                    die("not validated");
                    if ($option == "modify") {
                        redirect('institute/modify/id_chosen/' . $this->input->post('institution_id'));
                        return;
                    }
                }
            }
        }


        $this->page->loadViews(
                array(
            array("Institutions", "sidebars/inst_common"),
            array("Administration", "sidebars/inst_admin")
                ), array(
            array("Create New Instituion", "forms/createInst")
                ), null);
    }

    function join($mode = "", $id = "") {
        // Join an Institution
        
        
        $this->load->model('User_inst');
        
        $this->page->title = "Join An Institution";
        $this->defaultBreadcrumb['Join An Institution'] = "";
        $this->page->breadcrumbs = $this->defaultBreadcrumb;
        $uname = $this->User->Authenticate();
        if (!$uname)
            return;

        if (!empty($mode)) {
            if ($mode == "id_chosen") {
                if (!isset($id)) {
                    $this->page->showMessage("Error: Must Choose An ID");
                    return;
                }
            } else if ($mode == "ref_chosen") {
                $this->form_validation->set_rules('id', 'Institute ID', 'required');
                $this->form_validation->set_rules('referer', 'Referer Username', 'max_length[20]|callback_validate_referer');
                $this->form_validation->set_message('validate_referer', 'This Referer username is invalid!');
                if ($this->form_validation->run()) {
                    // success! Check if institute exists
                    $id = $this->input->post('id');
//                   $this->load->model('Institution');
                    $this->Institution->institution_id = $id;
                    if (!$this->Institution->Load()) {
                        $this->page->showMessage("Institution ID " . $this->Institution->institution_id . " was not found!");
                        return;
                    }
                    if ($this->Institution->status != "approved") {
                        $this->page->showMessage("This institution is not approved yet.");
                        return;
                    }
                    // Future implementation: check if the referer valid
                    $this->User_inst->username = $uname;
                    $this->User_inst->institution_id = $id;
                    $this->User_inst->referer = $this->input->post('referer');
                    $this->User_inst->role = "pending";
                    if ($this->User_inst->IsAvailable()) {
                        $this->User_inst->Insert();
                        $this->page->showMessage("You are successfully applied for the Institution.");
                    } else {
                        $this->page->showMessage("You have already applied for the institution!");
                    }
                    return;
                }
            }
            $this->defaultBreadcrumb['Join An Institution'] = site_url('institute/join');
            $this->defaultBreadcrumb['Choose Referer'] = "";
            $this->page->breadcrumbs = $this->defaultBreadcrumb;
            
            $this->page->loadViews(
                    array(
                array("Institutions", "sidebars/inst_common"),
                array("Administration", "sidebars/inst_admin")
                    ), array(
                array("Choose A Referer", "forms/choose_referer", array("id" => $id, "controller" => "institute")),
                    ), null
                    );
            return;
        }

        // Load  Models
//       $this->load->model('Institution');
        $instList = $this->Institution->GetAllApproved();
        
        // Get referer requests
        $refData = $this->User_inst->GetRefererRequests($uname);

        $this->page->loadViews(
                array(
            array("Institutions", "sidebars/inst_common"),
            array("Administration", "sidebars/inst_admin")
                ), array(
            array("Join An Instituion", "institution/listAll", array("list" => $instList)),
                ), 
                array(
                    array("Requests", "sidebars/referer_requests", array("instData" => $refData))
                )
                );
    }

    function modify($mode = "", $id = "") {
        // Modify an Institution
        $this->page->title = "Modify An Institution";
        $this->defaultBreadcrumb['Modify An Institution'] = "";
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

                $this->Institution->institution_id = $id;


                if (!$this->Institution->Load()) {
                    $this->page->showMessage("Could not load Institution " . $this->Institution->institution_id);
                    return;
                }

                // All Validated. do something here.
                $this->defaultBreadcrumb['Modify An Institution'] = site_url('institute/modify');
                $this->defaultBreadcrumb['Edit'] = "";
                $this->page->breadcrumbs = $this->defaultBreadcrumb;
                $this->page->loadViews(
                        array(
                    array("Institutions", "sidebars/inst_common"),
                    array("Administration", "sidebars/inst_admin")
                        ), array(
                    array("Edit Institution", "forms/modifyInst", array("instData" => $this->Institution)),
                        ), null);
                return;
            }
        }

        // Load  Models
//       $this->load->model('Institution');
        $instList = $this->Institution->GetAll();

        $this->page->loadViews(
                array(
            array("Institutions", "sidebars/inst_common"),
            array("Administration", "sidebars/inst_admin")
                ), array(
            array("Modify An Institution", "institution/listAll", array("list" => $instList, "action" => "modify")),
                ), null);
    }

    function view($institution_id, $option="") {

        // validations not required since this is general view
//      $this->load->model('Institution');
        $this->Institution->institution_id = $institution_id;
        if (!$this->Institution->Load()) {
            $this->page->showMessage("The Institution you specified was not found");
            return;
        }



        if ($option == "community") {
            // Load this page's community. Here we may need validation if the user joined this community
            redirect('community/index/' . $this->Institution->community_id);
            return;
        }
        
        // Get fields for this institute
        $this->load->model('Field');
        $fieldsArr = $this->Field->GetFieldByInst($institution_id);
        
        // Get Events
        $this->load->model('model_event','Event');
        $eventsArr = $this->Event->GetByCommunityId($this->Institution->community_id);
        
        // Get News
        $this->load->model('model_news','News');
        $newsArr = $this->News->GetByCommunityId($this->Institution->community_id);
        
        
        $this->defaultBreadcrumb[$this->Institution->short_name] = "";
        $this->page->breadcrumbs = $this->defaultBreadcrumb;
        $this->page->title = $this->Institution->name . " | Institution";

        $this->page->loadViews(
                null, array(
            array($this->Institution->name, "institution/view", array(
                "instData" => $this->Institution,
                "fieldsData" => $fieldsArr,
                "eventsData" => $eventsArr,
                "newsData" => $newsArr
                    ))
                ), null);
    }
    
    function pendingMembers($mode, $id, $chosenUsername = "", $status="member") {
        // Approve pending Members
        $this->page->title = "Pending Membership";
        $this->defaultBreadcrumb['Pending Membership'] = "";
        $this->page->breadcrumbs = $this->defaultBreadcrumb;
        $uname = $this->User->Authenticate();
        
        if(!$uname)
            return;
        
        // validate if the user is really member of this community
        
        $this->load->model('User_inst');
        
        if(! $this->User->AuthenticateAsAdmin()){
            $this->User_inst->institution_id = $id;
            $this->User_inst->username = $uname;
            if(!$this->User_inst->ValidateMembership()){
                $this->page->showMessage("You are not a member of this Institution!");
                return;
            }
        }else{
//            die("Admin!!");
        }
        
        // validate Institution
        
        $this->Institution->institution_id = $id;
        if(! $this->Institution->Load()){
            $this->page->showMessage("Invalid Institute ID");
            return;
        }
        
        switch ($mode){
            case 'list':
                
                $data = $this->User_inst->GetPendingMembers($id);
                
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
                
                $this->User_inst->institution_id = $id;
                $this->User_inst->username = $chosenUsername;
                
                if(!$this->User_inst->Load()){
                    $this->page->showMessage("Invalid username/institute ID");
                    return;
                }
                
                $this->User_inst->referer = $uname;
                $this->User_inst->role = $status;
                $this->User_inst->Update();

                // insert in user_community

                // fetch comm id

                if($status == "member"){
                    $this->Institution->institution_id = $id;
                    $this->Institution->Load();
                    $this->load->model('User_community');
                    $this->User_community->Insert($chosenUsername, $this->Institution->community_id);
                }
                
                $this->page->showMessage("Updated Successfully!");
                return;
                
                break;
            default:
                //nothings
        }
        
        $this->page->loadViews(
                        array(
                    array("Institutions", "sidebars/inst_common"),
                    array("Administration", "sidebars/inst_admin")
                        ), array(
                    array("Approve Pending Membership", "institution/listPendingMembers", array(
                        "data" => $data, "instituteId" => $id
                        )),
                        ), null);
    }

}

?>