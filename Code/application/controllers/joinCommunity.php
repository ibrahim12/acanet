
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   class joinCommunity extends CI_Controller {

           function __construct()
           {
                   parent::__construct();
           }
           function index($community_id)
           {
                $this->load->model("Model_user");
                $this->load->model("User_community");
                $username = $this->Model_user->Authenticate();
                $this->User_community->SetUserCommunityRelation($username,$community_id);
                echo $redirect;
                redirect(site_url("community/index/$community_id"));
           }
           
           function LoadJoinCommunityView()
           {
                //No join community view
           }
           function Join()
           {
             
           }
   }

?>