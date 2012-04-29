<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Community_list extends CI_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function index($community_type=null) {
        if(isset($community_type)){
            $this->LoadCommunityListView($community_type);
        }
        else{
            $this->LoadCommunityListViewAll();
        }
    }

    function LoadCommunityListViewAll() {
        $this->load->model('Model_community');
        $this->load->model('Model_user');
        $this->load->model('User_community');
        $username = $this->Model_user->GetLoggedInUsername();
        $communities = $this->User_community->GetByUserName($username);
        
        $this->page->title = "List of Communities By Type";

        $this->page->breadcrumbs = array(
            "Home" => base_url(),
            "Community_list" => site_url("community_list"),
        );

        
        $data['query1_result'] = $this->Model_community->GetByType('institution',5);
        $data['query2_result'] = $this->Model_community->GetByType('field',5);
        $data['query3_result'] = $this->Model_community->GetByType('subject',5);
        $data['query4_result'] = $this->Model_community->GetByType('course',5);
        $data['query5_result'] = $this->Model_community->GetByType('group',5);
        $data['communities'] = $communities;

        $main_content[0] = array("Community List", "community_list_view_all",$data);


        $this->page->loadViews(null, $main_content, null);
    }

    function LoadCommunityListView($community_type) {
        $this->load->model('Model_community');
        $this->load->model('Model_user');
        $this->load->model('User_community');
        $username = $this->Model_user->GetLoggedInUsername();
        $communities = $this->User_community->GetByUserName($username);

        switch($community_type){case 'institution': case 'field': case 'subject': case 'course': case 'group': break; default: echo '<h1>bad community type<h1>';return;break;}
        $this->page->title = "List of Communities of type : $community_type";


        $this->page->breadcrumbs = array(
            "Home" => base_url(),
            "Community" => site_url("community_list"),
            "$community_type" => site_url("community_list/$community_type")
        );


        $data['query_result'] = $this->Model_community->GetByType($community_type);
        $data['communities'] = $communities;
        $data['type'] = $community_type;

        $main_content[0] = array("Community List", "community_list_view",$data);

        $this->page->loadViews(null, $main_content, null);
    }

 

    function GetByType() {
        $this->type = $this->input->post('type');

        $this->db->select("name,community_id");
        $query = $this->db->get_where('community', array('type' => $this->type, 'community_id >' => 0));
        $this->load->view($this->page->theme . 'ajax_request/community_load_list.php',
                array("allCommunity" => $query->result_array()));
    }

}

?>