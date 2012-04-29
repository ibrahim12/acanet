<?php

class Model_event extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    //@order is given as associative array .ex. array('title'=>'ASC','date'=>'DESC');
    function Get($id=null, $order="", $start=0, $limit=10,$obj=false) {
        $this->db->select('*');
        $query = "";
        if ($id != null) {
            $query = $this->db->get_where('event', array('event_id' => $id), 1);
        } else {
            if ($order != "" && is_array($order)) {
                foreach ($order as $key => $val) {
                    $this->db->order_by($key, $val);
                }
            }
            $query = $this->db->get('event', $limit, $start);
        }
        if (!$obj)
            return $query->result_array();
        else
            return $query->result();
    }

    function Add($title, $description, $start_time, $end_time, $publisherName) {
        $this->db->set('title', $title);
        $this->db->set('description', $description);
        $this->db->set('start_date_time', $start_time);
        $this->db->set('end_date_time', $end_time);
        $this->db->set('publisher_name', $publisherName);
        $result = $this->db->insert('event');
        return $this->db->insert_id();
    }

    function SetEventCommunityRelation($eventId, $cId) {
        $this->db->set('event_id', $eventId);
        $this->db->set('community_id', $cId);
        return $result = $this->db->insert('event_community');
    }

    function GetByCommunityId($community_id) {
        $query_str = "SELECT event.event_id, event.title, event.description, event.start_date_time, event.end_date_time, event.publisher_name
                        FROM (event JOIN event_community ON event.event_id = event_community.event_id)
                            JOIN community on event_community.community_id = community.community_id
                        WHERE community.community_id = '$community_id'
                        ORDER BY event.start_date_time DESC";
        $query = $this->db->query($query_str);
        //print_r($query->result_array());
        return $query->result();
    }

}

?>