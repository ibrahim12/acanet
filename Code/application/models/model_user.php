<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Model_user extends CI_Model {

    var $username = "";
    var $password = "";
    var $name = "";
    var $address = "";
    var $contact_number = "";
    var $mail_address = "";
    var $type = "";
    var $status = "";
    var $verification = "";

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
        //echo $username . $param;
        $array = array('username' => $username, 'verification_data' => $param);
        $this->db->where($array);
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            $temp = $query->result_array();
            // echo "entered";

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
        $this->db->where(array('username' => $username));
        if($this->db->count_all_results('user') == 1){
//            die("inside");
            return true;
        }
//        die("ouside");
        return false;
    }

    function GetLoggedInUsername() {
        return $this->session->userdata('username');
    }

    function Authenticate() {
        // Redirects if not logged in.
        // Added by Shafiul
        if (!$this->GetLoggedInUsername()) {
            $this->page->showMessage('You are not logged in. <br /><br />' . anchor('login', 'Click here to Log in'));
            return false;
        }
        return $this->GetLoggedInUsername();
    }
    
    function AuthenticateAsAdmin($returnOnly = true){
        // check if logged in user is Admin
        $uname = $this->Authenticate();
        if(! $this->IsAdmin($uname)){
            if(!$returnOnly)
                $this->page->showMessage("Access Denied: Administrator access required.");
            return false;
        }
        return $uname;
    }

    function CheckUsernamePassword($username, $password) {
        $md5_password = md5($password);
        $where = array('username' => $username, 'password' => $md5_password, 'status' => 'activated');
        $this->db->where($where);
        $query = $this->db->get('user');
        if ($query->num_rows() == 0) {
            return false;
        }
        return true;
    }
    function IsAdmin($username){
        $where = array('username' => $username , 'type' => 'admin');
        $this->db->where($where);
        $query = $this->db->get('user');
        if ($query->num_rows() == 0) {
            return false;
        }
        return true;


    }
    function Add() {

    }

    function Get($id=null) {

    }

    function Update($username, $data) {
        $where_array = array('username' => $username);
        $this->db->where($where_array);
        $this->db->update('user', $data);
    }

    // added by sifat
    function GetByCommunityId($community_id,$select='*',$admin=false) {

        $this->db->select($select)
                    ->from('user')
                    ->join('user_community','user.username = user_community.username')
                    ->join('community','user_community.community_id = community.community_id')
                    ->where('community.community_id',$community_id);
        if($admin){
            $this->db->where('user_community.role','admin');
        }
        else{
            $this->db->where('user_community.role','subscriber');
        }
        $query = $this->db->get();

        return $query->result();
    }

}

?>