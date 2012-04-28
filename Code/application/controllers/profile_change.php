<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Profile_change extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function ChangeName() {
        $this->form_validation->set_rules('changed_name', 'name', 'required');
         $this->load->model('model_user', 'User');
        $username = $this->User->Authenticate();
        if ($this->form_validation->run() == FALSE) {
              redirect("profile/index/$username/2/Name not valid");
        } else {
           
            
            if ($username) {  // echo $username;
                $data = array('name' => $this->input->post('changed_name'));
                $this->User->update($username, $data);
                redirect("profile/index/$username/0");
            }
        }
    }

    function ChangeAddress() {
        $this->form_validation->set_rules('changed_address', 'address', 'required');
        $this->load->model('model_user', 'User');
        $username = $this->User->Authenticate();
        if($this->form_validation->run() == false)
                redirect("profile/index/$username/3/Address not valid");
        if ($username) {  echo "entered";
            $data = array('address' => $this->input->post('changed_address'));
            $this->User->update($username, $data);
            redirect("profile/index/$username/0");

        }
    }

    function ChangeNumber() {
        $this->form_validation->set_rules('changed_number', 'number', 'required');
        $this->load->model('model_user', 'User');
        $username = $this->User->Authenticate();
        if($this->form_validation->run() == false)
                redirect("profile/index/$username/4/Contact Number not valid");
        if ($username) {  // echo $username;
            $data = array('contact_number' => $this->input->post('changed_number'));
            $this->User->update($username, $data);
            redirect("profile/index/$username/0");

        }
    }

    function ChangeMailAddress() {
        $this->form_validation->set_rules('changed_mail_address', 'mail_address', 'required');
        $this->load->model('model_user', 'User');
        $username = $this->User->Authenticate();
        if($this->form_validation->run() == false)
                redirect("profile/index/$username/5/Mail Address not valid");
        if ($username) {  // echo $username;
            $data = array('mail_address' => $this->input->post('changed_mail_address'));
            $this->User->update($username, $data);
            redirect("profile/index/$username/0");

        }
    }
    function updatePrivacy(){
        $this->load->library('util');                
        $this->load->Model('Model_user');
        $privacy = $this->input->post('privacy');        
        $val = $this->util->BitArray2Value($privacy,4);
        $username = $this->Model_user->Authenticate();        
        $this->Model_user->Update($username,array("privacy"=>$val));
        redirect("profile/index/$username/");
    }

}

?>