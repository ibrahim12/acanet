
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    private $login_data;
    private $autofill_username = "";
    //private $autofill_password = "";
    private $message = "";
    function __construct() {

        parent::__construct();
        $this->login_data = null;
    }

//===================================================================================================================================
    /*
     * this function does the main task of login
     * it loads the login form over and over until
     * correct info is given
     *
     */
    function index() {

        if ($this->input->post('cmdweblogin')) {
            //$this->FormValidation();
            if ($this->FormValidation() == false) {
                $this->autofill_username = $this->input->post('username_2');
                $this->message = "invalid username/password or account is not activated";
                $this->LoadLoginView();
            } else {
                $this->login_data = $this->input->post('username_2');
                //======================================================
                //attention please *************************************
                //integrate with home page code needs to be written here
                //******************************************************
                //======================================================
                redirect('home');
            }
        } else {

            $this->LoadLoginView();
        }
    }
//===================================================================================================================================


//===================================================================================================================================
    /*
     * this function is for loading the necessary views 
     */

    function LoadLoginView() {

        $this->page->title = "Welcome to AcaNet";

//        $this->page->nav1 = array(
//            "Home" => base_url(),
//            "Registration" => site_url('register')
//        );
//
//        $this->page->nav2[] = array(
//            array("Field", site_url('field')),
//            array('Computer Science' => site_url('field/cse'))
//        );



        $this->page->breadcrumbs = array(
            "Home" => base_url(),
            "Login" => site_url('login')
        );

        $this->page->loadViews(
                null,
                array(
                    array("Log in please!", "forms/login", array('username' => $this->autofill_username
                            // ,'password' => $this->autofill_password
                            , 'message' => $this->message))
                ),
                null);
    }

//===================================================================================================================================

//===================================================================================================================================
    /*
     * checks whether the username,password is in database
     * and user is in activated state 
     * if valid user allow him to log in and set a session 
     */
    function FormValidation() {
        
        $username = $this->input->post('username_2');
        $password = $this->input->post('password_2');
        if ($username === null || $password === null) {
            return false;
        } else {
            $this->load->model('model_user', 'User');

            if ($this->User->CheckUsernamePassword($username, $password)) {
                $data = array('username' => $username);
                $this->session->set_userdata($data);
                return true;
            }
            return false;
        }
    }

//===================================================================================================================================


}

?>
