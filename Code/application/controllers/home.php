
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class home extends CI_Controller {

    var $currentUsername = '';
    var $isPublicView = true;

    function __construct() {
        parent::__construct();
        $isPublicView = true;
    }

    function index() {
        $this->LoadHomeView();
    }

    function LoadHomeView() {
        $this->load->model('Model_news');
        $this->load->model('Model_event');
        $this->load->model('Model_user');
        $this->load->model('User_community');
        $this->load->model('Model_community');
        $this->load->model('Institution');
        $this->load->model('Field');
        $this->load->library('util');
        $this->load->model('User_inst');
        $this->load->model('User_field');

        $this->currentUsername = $this->Model_user->GetLoggedInUsername();
        if ($this->currentUsername !== false)
            $this->isPublicView = false;


        $this->page->title = "Home";

        $this->page->breadcrumbs = array(
            "Home" => base_url()
        );

        $nav1 = array();

        if ($this->isPublicView) {
           $nav1["Login"] = site_url('login');
            $nav1["Registration"] = site_url('register');

        } else {
            $nav1[$this->currentUsername] = site_url('profile');
            $nav1["Logout"] = site_url('logout');
        }
        $username = $this->currentUsername;

       // $this->page->nav1 = $nav1;

        //$this->load->model('Model_post','userPost');
        //$this->load->model('institution','Institutions');
        //$instiutionList = $this->Institutions->GetInstitutionList();
//              $order = array('date_time'=>'desc');
//              $allPosts = $this->userPost->Get(null,$order);
        $this->page->set(array('jquery-ui-1.8.12.custom'), 'css');
        $this->page->set(array('timepicker-addon'), 'css');
        $this->page->set(array('fancybox/jquery.fancybox-1.3.4'), 'css');


        $js = array(
            'jquery-ui-1.8.12.custom.min', 'jquery-ui-timepicker-addon',
            'home', 'curvycorners', 'fancybox/jquery.fancybox-1.3.4.pack',
            'fancybox/jquery.mousewheel-3.0.4.pack', 'autoresize'
        );

        $this->page->set($js, 'js');


        $this->page->set(array('home'), 'css');

        //print_r($allPosts);
        $order = array('date_time' => 'desc');
//---------------------Load Ins Filed Comm ---------------------------//
        $allCommunities = $this->page->allCommunities;
        $allFields = $this->page->allFields;
        $allInstitution = $this->page->allInstitution;

//            $allCommunities = array();
//            $allFields = array();
//            $allInstitution = array();
//            $limit = 10;
//            if(!$this->isPublicView){
//                $allCommunities = $this->User_community->GetByUserName($username,"",0,$limit);
//                $allFields = $this->Field->GetByUserName($username);
//                $allInstitution = $this->Institution->GetByUserName($username);
//            }
//            else{
//                $allCommunities = $this->Model_community->GetByType('groups',$limit);
//                $allFields = $this->Field->GetAllPublic();
//            }
//            $comLinks = array();
//            foreach($allCommunities as $aCommunity){
//                $comLinks[$aCommunity->name] = site_url('community').'/'.$aCommunity->community_id;
//            }
//            $insLinks = array();
//            foreach($allInstitution as $aIns){
//                $insLinks[$aIns->short_name] = site_url('institute').'/view/'.$aIns->institution_id;
//            }
//            $fieldsLinks =array();
//            foreach($allFields as $aField){
//                $fieldsLinks[$aField->short_name] = site_url('field').'/view/'.$aField->field_id;
//            }
//            $nav2 = array();
//            $nav2EntryHeader1 = array("Home", base_url());
//            $nav2EntryHeader2 = array( "Communities", "community/index/");
//            $nav2EntryHeader3 = array("Institutions", "institute/index");
//            $nav2EntryHeader4 = array( "Fields", "fields/index");
//
//            $nav2EntryDropDown1 = array();
//            $nav2EntryDropDown2 = $comLinks;
//            $nav2EntryDropDown3 = $insLinks;
//            $nav2EntryDropDown4 = $fieldsLinks;
//
//            $nav2[0] = array($nav2EntryHeader1,$nav2EntryDropDown1);
//            $nav2[1] = array($nav2EntryHeader2,$nav2EntryDropDown2);
//            $nav2[2] = array($nav2EntryHeader3,$nav2EntryDropDown3);
//            $nav2[3] = array($nav2EntryHeader4,$nav2EntryDropDown4);
//
//            $this->page->nav2 = $nav2;
//            $this->page->nav2 = array(
//                        array(
//                              array(
//                                    "Home", base_url()
//                                   )
//                              ),
//                        array(
//                            array(
//                                  "Communities", "community/index/"
//                                ),
//                                $comLinks
//                            ),
//                        array(
//                            array(
//                                   "Institutions", "institute/index"
//                                ),
//                                $insLinks
//                            ),
//                       array(
//                            array(
//                                   "Fields", "fields/index"
//                                ),
//                                $fieldsLinks
//                            )
//                    );
//---------------------Load Ins Filed Comm ---------------------------//
        /*         * *********************************LEFT SIDEBAR START****************************** */
        /* Sifat community copy */

        $left_sidebar = array();
        $left_sidebar[] = array('Welcome!', 'sidebars/welcome');
        if (!$this->isPublicView)
            $left_sidebar[] = array('Actions', 'sidebars/homeTabActions');
        if (count($allCommunities) > 0)
            $left_sidebar[] = array('Communities', "sidebars/communities",
                array('allCommunities' => $allCommunities));
        if (count($allFields) > 0)
            $left_sidebar[] = array('Fields', "sidebars/fields", array('allFields' => $allFields));
        if (count($allInstitution) > 0)
            $left_sidebar[] = array('Institution', "sidebars/institution", array('allInstitution' => $allInstitution));

        /*         * *********************************LEFT SIDEBAR END****************************** */



        /*         * *********************************MAIN CONTENT START**************************** */



        $main_content = array();
        $main_content[0] = array("Home", "home", array("username" => $this->currentUsername));

        //$allPosts = $this->GetRecentPosts();
        //$main_content[1] =  array(null, "recent_posts",array("allPosts"=>$allPosts));

        /*         * *********************************MAIN CONTENT END****************************** */


        /*         * *********************************RIGHT SIDEBAR START****************************** */
        //$data =array();
        $news = $this->Model_news->Get(null, $order, 0, 5, true);
        $event = $this->Model_event->Get(null, array('start_date_time' => 'desc'), 0, 2, true);

        //$this->util->FreshPrint($event);

        /* Sifat community copy */

        // Load referer requests
        //
        //
        $right_sidebar = array();
        // Get referer requests
        $uname = $this->page->currentUser;
        if ($uname) {
            $refInstData = $this->User_inst->GetRefererRequests($uname);
            $refFieldData = $this->User_field->GetRefererRequests($uname);

            $right_sidebar[] = array("Requests","sidebars/referer_requests", array(
                "instData" => $refInstData,
                "fieldData" => $refFieldData
            ));
        }




        $right_sidebar[] = array("Events", "sidebars/events", array("event" => $event));
        $right_sidebar[] = array("News", "sidebars/news", array("news" => $news));

        /*         * *********************************RIGHT SIDEBAR END****************************** */


        $this->page->loadViews(
                $left_sidebar,
                $main_content,
                $right_sidebar
        );
    }

    function GetRecentPosts() {
        $username = $this->input->post('username');
        $oldPostsId = $this->input->post('postsId');

        $this->load->model('Model_post', 'userPost');
        $order = array('date_time' => 'desc');
        $allPosts = $this->userPost->Get(null, $order, 0, 10, true);
        return $allPosts;
        //echo json_encode($allPosts,JSON_FORCE_OBJECT);
    }

    function PrintRecentContents() {
        $this->load->model('Model_user');
        $this->load->model('Model_content');
        $this->load->library('util');
        $allContent = array();

        $this->currentUsername = $this->Model_user->GetLoggedInUsername();
        if ($this->currentUsername !== false)
            $this->isPublicView = false;

        $allContent = array();
        if (!$this->isPublicView)
            $allContent = $this->Model_content->GetByUser($this->currentUsername, 0, 10, 'date_time desc');

        $this->load->view($this->page->theme . 'recent_contents.php', array('allContent' => $allContent));
    }

    function PrintRecentPosts() {


        $this->load->model('model_post');
        $this->load->model('Model_user');



        $username = $this->input->post('username');
        if ($username != "") {
            $this->currentUsername = $this->Model_user->GetLoggedInUsername();
            if ($this->currentUsername !== false)
                $this->isPublicView = false;
        }

        //$oldPostsId = $this->input->post('postsId');
        //$oldPostsId = json_decode($oldPostsId);

        $order = array('date_time' => 'desc');

        //$this->db->select('*');
        //$query = $this->db->get_where('post');
        //$allPosts = $query->result_array();


        $where = array();
        if (!$this->isPublicView)
            $where = array("publisher_name" => $username, "title !=" => "");


        $start = 0;
        $limit = 10;

        $allPosts = $this->model_post->Get(null, $order, $start, $limit, true, $where);

        $count = count($allPosts);
        $order = array('date_time' => 'inc');
        for ($i = 0; $i < $count; $i++) {
            $where = "post.post_id in (select reply_id from post_reply where post_reply.post_id =" . $allPosts[$i]->post_id . ")";
            $allPosts[$i]->replyies = $this->model_post->Get(null, $order, $start, $limit, true, $where);
        }

        $this->load->view($this->page->theme . 'recent_posts.php', array('allPosts' => $allPosts));
    }

}

?>