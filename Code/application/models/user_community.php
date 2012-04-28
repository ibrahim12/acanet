<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 */

class User_community extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function GetByUserName($name,$type="", $start=0, $limit=100) {
        $query_str = "SELECT DISTINCT * FROM `user_community`
       JOIN community ON user_community.community_id = community.community_id
       WHERE `username` = '$name'";
        if($type != "")$query_str .= "AND community.type = '$type'";
       $query_str .= "LIMIT $start, $limit";
        $query = $this->db->query($query_str);
        return $query->result();
    }

    function Insert($username, $community_id, $role="subscriber") {
        $data = array('username' => $username, 'community_id' => $community_id, 'role' => $role);
        $this->db->insert('user_community', $data);
    }

    function SetUserCommunityRelation($username, $community_id,$role="subscriber")
    {
        $this->db->where(array('username =' => $username));
        $this->db->where(array('community_id =' => $community_id));
        if($this->db->count_all_results('user_community') > 0){ return;}
        $this->db->set('username', $username);
        $this->db->set('community_id', $community_id);
        $this->db->set('role', $role);
        return $result = $this->db->insert('user_community');
    }

}

?>
