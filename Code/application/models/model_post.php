<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Model_post extends CI_Model {

       
       function __construct()
       {
           // Call the Model constructor
           parent::__construct();
       }
       //@order is given as associative array .ex. array('title'=>'ASC','date'=>'DESC');
       function Get($id=null,$order="",$start=0,$limit=10,$obj=false,$where=array())
       {
         $select = 'post.post_id,post_community.community_id,
                           publisher_name,description,date_time,
                           name,type,title';         
                  
         $this->db->select($select)
                    ->from('post')
                    ->join('post_community','post.post_id=post_community.post_id')
                    ->join('community','community.community_id=post_community.community_id')                    
                    ->limit($limit,$start);         
         $query = "";
         if($id!=null){            
           $this->db->where("post_id='$id'");           
         }
         else{
             if(!empty($where))
                 $this->db->where($where);
             
            if($order!="" && is_array($order))
            {
               foreach($order as $key=>$val)
               {    
                  $this->db->order_by($key,$val);
               }
            }                                
         }
         $query = $this->db->get();         
         if(!$obj)
            return  $query->result_array();
         else
            return $query->result();
         
        
       }
       
       function Add($description,$publisherName,$title="")
       {           
           $this->db->set('title',$title);
           $this->db->set('description',$description);
           $this->db->set('publisher_name',$publisherName);
           $this->db->set('date_time',"now()",false);                      
           $result = $this->db->insert('post');
           if(!$result)echo "Unable to insert posts";
           return $this->db->insert_id();
       }
       function SetPostCommunityRelation($postId,$cId)
       {
           $this->db->set('post_id',$postId);
           $this->db->set('community_id',$cId);
           return $result = $this->db->insert('post_community');
       }
       function SetPostReplyRelation($postId,$cId,$replyId)
       {
           $this->db->set('post_id',$postId);
           $this->db->set('community_id',$cId);
           $this->db->set('reply_id',$replyId);
           return $result = $this->db->insert('post_reply');
       }
       function GetByUser($username){           
           $this->db->select('*');
           $query = $this->db->get_where('post',array('publisher_name'=>$username));
           return  $query->result_array();           
       }
       function GetByCommunityId($community_id,$start=0,$limit=10)
       {
           $query_str = "SELECT post_id,title,description,publisher_name,date_time
                        FROM post NATURAL JOIN post_community
                                NATURAL JOIN community
                        WHERE community.community_id = '$community_id'
                        ORDER BY date_time desc
                        LIMIT $start,$limit";
           $query = $this->db->query($query_str);
           return $query->result();
       }
       
       
   }

?>