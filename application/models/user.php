<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends CI_Model {

    var $username="";
    var $password="";
    var $name="";
    var $address="";
    var $contact_number="";
    var $mail_address="";
    var $type="";
    var $status ="";
    var $verification="";
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function InsertUser($data) {
        $store = array(
            'username' => $data['contact_username'],
            'password' => md5($data['contact_password']),
            'name' => $data['contact_firstname'] . " " . $data['contact_lastname'],
            'address' => $data['contact_address'],
            'contact_number' => $data['contact_phone'],
            'mail_address' => $data['contact_email'],
            'type' => 'subscriber',
            'status' => 'pending',
            'verification_data' => 'abcdef'
        );
        $this->db->insert('user', $store);

    }

    function GetUserVerifiactionData($user_id) {
        $this->db->select('verification_data');
        $this->db->where('username', $user_id);
        $query = $this->db->get('user');
        $data = $query->result_array();
        $result = $data[0]['verification_data'];
        return $result;
    }

    function CheckParamAndSetValue($username, $param) {
        $array = array('username' => $username, 'verification_data' => $param);
        $this->db->where($array);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $temp = $query->result_array();
            $data = array('status' => 'activated');
            $this->db->where('username', $username);
            $this->db->update('user', $data);
            return true;
        }

        return false;
    }

    function GetUserDataById($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        $list = $query->result_array();

        foreach ($list as $aQuery) {
            $result = $aQuery;
        }
        return $result;
    }

    function IsUsernameValid($username)
    {
        die("i got called");
        $this->db->where(array('username' => $username));
        if($this->db->count_all_results('user') == 1){
            die("inside");
            return true;
        }
        die("ouside");
        return false;
    }
    
    function GetLoggedInUsername()
    {
        // Modified by Shafiul
        return $this->session->userdata('username');
    }

    function Authenticate(){
        // Redirects if not logged in.
        // Added by Shafiul
        if(!$this->GetLoggedInUsername()){
            $this->page->showMessage('You are not logged in. <br /><br />' . anchor('login','Click here to Log in'));
            return false;
        }
        return $this->GetLoggedInUsername();
    }

    function CheckUsernamePassword($username,$password)
    {
        echo "has come";
        $md5_password = md5($password);
        $where = array('username'=>$username , 'password'=>$md5_password);
        $this->db->where($where);
        $query = $this->db->get('user');
        if($query->num_rows() == 0)
        {
            return false;
        }
        return true;
    }

    function Add() {

    }

    function Get($id=null) {

    }

    function Update($id) {
        
    }

}

?>