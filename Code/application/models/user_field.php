<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User_field extends CI_Model {

    var $username;
    var $field_id;
    var $role;
    var $referer;

    function __construct() {
        parent::__construct();
    }

    

    function Insert(){

        $this->db->insert('user_field', $this);
    }

    function Load(){
        if($this->IsAvailable())
            return false;
        $this->db->where(array(
            'username' => $this->username,
            'field_id' => $this->field_id)
                );
        $query = $this->db->get('user_field');
        foreach($query->result() as $row){
            $this->role = $row->role;
            $this->referer = $row->referer;
        }
        return true;
    }

    function IsAvailable(){
        $this->db->where(array(
            'username' => $this->username,
            'field_id' => $this->field_id
        ));
        if($this->db->count_all_results('user_field') > 0)
            return false;
        else
            return true;
    }

    function Update(){
        $this->db->where(array(
            'username' => $this->username,
            'field_id' => $this->field_id
        ));
        $this->db->update('user_field', $this);
    }

    function GetPendingMembers($fieldId){
        $this->db->where(array(
            'role' => 'pending',
            'field_id' => $fieldId
        ));
        $query = $this->db->get('user_field');
        return $query->result();
    }
    
    function GetRefererRequests($username){
        $this->db->from("user_field");
        $this->db->join("field", "field.field_id = user_field.field_id");
        $this->db->where(array(
            'role' => 'pending',
            'referer' => $username
        ));
        $query = $this->db->get();
        return $query->result();
    }
    
    function ValidateMembership(){
        // validates if given user is member of a given field,
        // also returns false if pending/banned etc.
        if($this->Load()){
            switch($this->role){
                case 'pending':
                    return false;
                case 'banned' :
                    return false;
                default:
                    return true;
                        
            }
        }
        return false;    
    }
    
    function GetRole(){
        // Returns role, else False if failed to load
        if($this->Load()){
            return $this->role;
        }
        return false;
    }
    function GetByUsername($username){
        $this->db->where("username",$username);
        $query = $this->db->get('user_field');
        return $query->result;
    }

}

?>
