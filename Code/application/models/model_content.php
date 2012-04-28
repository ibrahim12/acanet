<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 class Model_content extends CI_Model {


       function __construct()
       {
           // Call the Model constructor
           parent::__construct();
       }
       function Add($description,$publisherName,$content_link,$type)
       {
           $this->db->set('type',$type);
           $this->db->set('description',$description);
           $this->db->set('content_link',$content_link);
           $this->db->set('publisher_name',$publisherName);
           $this->db->set('date_time',"now()",false);
           $result = $this->db->insert('content');
           return $this->db->insert_id();
       }
       function SetContentCommunityRelation($contentId,$cId)
       {
           $this->db->set('content_id',$contentId);
           $this->db->set('community_id',$cId);
           return $result = $this->db->insert('content_community');
       }

       function GetByCommunityId($community_id)
       {
           $query_str = "SELECT content.content_id, content.type, content.content_link, content.publisher_name, content.date_time, content.description
                        FROM (content JOIN content_community ON content.content_id = content_community.content_id)
                            JOIN community ON content_community.community_id = community.community_id
                        WHERE community.community_id = '$community_id'";
           $query = $this->db->query($query_str);
           //print_r($query->result_array());
           return $query->result();
       }
       function GetByUser($username,$start=0,$limit=10,$order="")
       {
           $query_str = "SELECT content.content_id, content.type, content.content_link, content.publisher_name, content.date_time, content.description
                        FROM (content JOIN content_community ON content.content_id = content_community.content_id)
                        WHERE content_community.community_id in (select user_community.community_id from  user_community where username='$username')
                        order by $order
                        limit $start,$limit";
           $query = $this->db->query($query_str);           
           return $query->result();
       }
 }



?>
