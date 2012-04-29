
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class Make_post extends CI_Controller {

           function __construct()
           {
                   parent::__construct();
           }
           function index()
           {
              $this->load->model('Model_user');
              $this->load->model('Model_post','post');            
             // $loggedInUser = $this->Model_user->GetLoggedInUsername();
             // if($loggedInUser ===false || $loggedInUser != $publisherName)  //will cause problem for ajax ...fix it later
             //     redirect('login');
                  
              $publisherName = $this->input->post('publisherName');
              $description = $this->input->post('description');
              $cId = $this->input->post('cId');    
              if($publisherName=="" || $description=="" || $cId == 0){
                  echo -1;
                  return;
              }
              $type = $this->input->post('type');
              if($type == 'post'){                                                  
                  $title = $this->input->post('title');                                                  
                  $postId = $this->post->Add($description,$publisherName,$title);
                  $this->post->SetPostCommunityRelation($postId,$cId);                    
              }
              else if($type=='reply'){  //Reply
                  $postId = $this->input->post('postId');
                  $replyId = $this->post->Add($description,$publisherName,'');
                  $this->post->SetPostCommunityRelation($replyId,$cId);                    
                  $this->post->SetPostReplyRelation($postId,$cId,$replyId);
              }
              
              //Redirect
              $redirect = $this->input->post('redirect');
              if(isset($redirect)){
                  redirect($redirect);
              }
              
           }
           
           function ProcessPost($description)
           {               
               return strip_tags($description);
           }
   }

?>