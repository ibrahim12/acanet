
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class register extends CI_Controller {

    private $institution_list;
    private $register_data;

    function __construct() {
        parent::__construct();
        //$this->load->model(institution);
        $this->institution_list = null;
        // $this->page->set("registerscript","js");
    }
//===================================================================================================================================
    /*
     * loads the registration form over and over again
     * until correct info is given
     */
    function index() {
        $this->FormValidation();
        if ($this->form_validation->run() == FALSE) {
            $this->LoadRegistrationView();
        } else {
            $this->register_data = array();
            // following marked line should be replaced by
            // $this->register_data = $this->input->post()
            // but don't know why $this->input->post() doesn't work
            //-------------------------------------------------------------------------------------
            $this->register_data['contact_firstname'] = $this->input->post('contact_firstname');
            $this->register_data['contact_lastname'] = $this->input->post('contact_lastname');
            $this->register_data['contact_username'] = $this->input->post('contact_username');
            $this->register_data['contact_password'] = $this->input->post('contact_password') ;
            $this->register_data['contact_repassword'] = $this->input->post('contact_repassword') ;
            $this->register_data['contact_address'] = $this->input->post('contact_address') ;
            $this->register_data['contact_phone'] = $this->input->post('contact_phone');
            $this->register_data['contact_email'] = $this->input->post('contact_email');
            $this->register_data['contact_url'] = $this->input->post('contact_url');
            //-----------------------------------------------------------------------------------
            $this->StoreData();
        }
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     *  this function is used to load the necessary views for registration
     */

    function LoadRegistrationView() {
        $this->page->title = "Registration";
        $this->GetInstitutionList();
        $this->page->nav1 = array(
            "Home" => base_url(),
            "Login" => site_url('login'),
        );

        $this->page->breadcrumbs = array(
            "Home" => base_url(),
            "Registration" => site_url('register')
        );



        $this->page->loadViews(
                null,
                array(
                    array("Registration", "forms/registration", array('inst_list' => $this->institution_list))
                ),
                null);
    }
//===================================================================================================================================


//===================================================================================================================================
    /*
     *  this function is used for getting institutionlist
     *  from model_institution model
     */

    function GetInstitutionList() {
        if ($this->institution_list == null) {
            $this->load->model('Institution');
            $this->institution_list = $this->Institution->GetInstitutionList();
        }
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     *  Registration form validation rules
     */

    function FormValidation() {

        //rules for register form validation
        $this->form_validation->set_rules('contact_firstname', 'Firstname', 'required|max_length[25]');
        $this->form_validation->set_rules('contact_lastname', 'Lastname', 'required|max_length[25]');
        $this->form_validation->set_rules('contact_username', 'Username', 'callback_CheckUsername');
        $this->form_validation->set_rules('contact_password', 'Password', 'required|min_length[6]|max_length[15]|matches[contact_repassword]');
        $this->form_validation->set_rules('contact_repassword', 'Re Enter Password', 'required|min_length[6]|max_length[15]');
        //$this->form_validation->set_rules('contact_institution', 'Institution', 'callback_CheckInstitution');
        //$this->form_validation->set_rules('contact_field', 'Field', 'callback_CheckField');
        $this->form_validation->set_rules('contact_address', 'Address', 'max_length[100]');
        $this->form_validation->set_rules('contact_phone', 'Phone', 'callback_CheckPhone');
        $this->form_validation->set_rules('contact_email', 'Email', 'callback_CheckMail');
    }
//===================================================================================================================================


//===================================================================================================================================
    /*
     * checking username that is it already present in database
     */

    function CheckUsername($username) {
        $this->load->model('model_user','User');
        if ($this->User->IsUsernameValid($username)) {
            $this->form_validation->set_message('CheckUsername', 'The %s is used already please try another username');
            return false;
        }
        return true;
    }
//===================================================================================================================================


//===================================================================================================================================
    /*
     * checking that institution is in list
     */

    function CheckInstitution($inst) {
        $this->form_validation->set_message('CheckInstitution', 'The %s field must be present in Database');
        $this->GetInstitutionList();
        // echo $inst;

        foreach ($this->institution_list as $aInst) {

            if (trim($aInst['institution_id']) == trim($inst))
                return true;
        }

        return false;
    }
//===================================================================================================================================


//===================================================================================================================================
    /*
     * checking that field is in list
     */

    function CheckField($field) {
        $this->form_validation->set_message('CheckField', 'The %s field is not valid');
        //field checking will be added here
        return true;
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     * not implemented yet
     */

    function CheckAddress($address) {
        $this->form_validation->set_message('CheckAddress', 'The %s field is not valid');
        //address checking will be added here
        return true;
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     * not implemented yet
     */

    function CheckMail($mail) {
        $this->form_validation->set_message('CheckMail', 'The %s field is not valid');
        //Mail checking will be added here
        return true;
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     * not implemented yet
     */

    function CheckPhone($phone) {
        //$this->form_validation->set_message('CheckPhone', 'The %s field should be a number from 6 to 15 digit');
        //Phone checking will be added here
        return true;
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     * this function is used for sending verification email
     * not implemented completely because mail service is unavailable
     * in localhost.
     *
     */

    function SendVerificationEmail($username, $param, $mail_id) {
        $params = array('username' => $username, 'param' => $param);
        $this->load->view('mail_dummy', $params);
        //=========================================================================
        //this portion will be activated after the project is launched in a server
        //we cannot provide mail service in localhost
        /* $this->load->helper('email');
          $message = "click on the below link for email verification </br>
          "."<a href='" .site_url."/verifyuser/index.php/".$param .">".$param."</a>";
          send_email("$mail_id","Academic_network_email_verification",message);
         */
        //==========================================================================
    }
//===================================================================================================================================

//===================================================================================================================================
    /*
     * function for calling the model_user to store the Data
     *
     */

    function StoreData() {
        $this->load->model('model_user','User');
        // $this->load->model('Inst_user');
        //$this->load->model('Field_user');
        //$this->load->model('Field');
        //$this->load->model('Institution');
        //$this->load->model('User_community');
        // print_r($this->register_data);
        
        $this->User->InsertUser($this->register_data);
        $param = $this->User->GetUserVerifiactionData($this->register_data['contact_username']);

        // $this->Inst_user->Insert($this->register_data['contact_username'], $this->register_data['contact_institution']);
        // $this->Field_user->Insert($this->register_data['contact_username'], $this->register_data['contact_field']);
        // $this->User_community->Insert($this->register_data['contact_username'], $this->Institution->GetCommunityId($this->register_data['contact_institution']));
        // $this->User_community->Insert($this->register_data['contact_username'], $this->Field->GetCommunityId($this->register_data['contact_field']));
        $this->SendVerificationEmail($this->register_data['contact_username'], $param, $this->register_data['contact_email']);
    }
//===================================================================================================================================
}

?>