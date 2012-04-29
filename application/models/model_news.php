<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Model_News extends CI_Model {

       function __construct()
       {
           // Call the Model constructor
           parent::__construct();
       }
       
       //@order is given as associative array .ex. array('title'=>'ASC','date'=>'DESC');
       function Get($id=null,$order="",$start=0,$limit=10,$obj=false)
       {
         $this->db->select('*');
         $query = "";
         if($id!=null){         
           $query = $this->db->get_where('news',array('news_id'=>$id),1);           
         }
         else{
            if($order!="" && is_array($order))
            {
               foreach($order as $key=>$val)
               {
                  $this->db->order_by($key,$val);
               }
            }

            $query = $this->db->get('news',$limit,$start);
         }
         if(!$obj)
            return  $query->result_array();
         else 
            return  $query->result();
        
       }

       function Add($publisherName,$heading,$content,$type)
       {
           $this->db->set('publisher_name',$publisherName);
           $this->db->set('heading',$heading);
           $this->db->set('content',$content);		   
           $this->db->set('type',$type);
            
           $this->db->set('date_time',"now()",false);
           $result = $this->db->insert('news');
           return $this->db->insert_id();
		   
       }
       function SetNewsCommunityRelation($newsId,$cId)
       {
           $this->db->set('news_id',$newsId);
           $this->db->set('community_id',$cId);
           return $result = $this->db->insert('news_community');
       }

       function GetByCommunityId($community_id)
       {
           $query_str = "SELECT news.news_id,news.heading,news.content,news.type,news.publisher_name,news.date_time
                        FROM (news JOIN news_community ON news.news_id = news_community.news_id)
                            JOIN community on news_community.community_id = community.community_id
                        WHERE community.community_id = '$community_id'";
           $query = $this->db->query($query_str);
           return $query->result();
       }
   }

?>