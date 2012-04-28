<?php

    /* ****** ****** ****** ****** ****** ******
    *
    * Author       :   Shafiul Azam
    *              :   ishafiul@gmail.com
    *              :   Core Developer
    * Page         :
    * Description  :
    * Last Updated :
    *
    * ****** ****** ****** ****** ****** ******/



class Page {
    //put your code here
    public $CI;

    public $theme = "default/";

    public $cssjsDir = 'templates/';

    public $defaultCssArr = array();
    public $cssArr = array();
    public $jsArr = array();
    public $defaultJsArr = array('jquery-1.5.2.min','registerscript');

    public $title = 'Academic Network';

    public $nav1;

    public $nav2;
    public $breadcrumbs;

    public $allCommunities;
    public $allFields;
    public $allInstitution;

    public $currentUser;

    function  __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('session');
        
        if($uname = $this->CI->session->userdata('username')){
            $this->nav1 = array(
                $uname => site_url('profile')."/index/$uname",

                "Logout" => site_url('logout')
            );
        }else{
            // Not Logged In
            
            $this->nav1 = array(
                "Home" => base_url(),
                "Login" => site_url('login'),
                "Registration" => site_url('register')
            );
        }
        
        
        // dummy breadcrumb
        $this->breadcrumbs = array(
            "Home" => base_url(),
            "Members" => "#",
            "Something" => "#"
        );

        // dummy nav2 : Should be set in the controller page
        //multidimention array --> ([]([main name,url])([subnames]=>url))
        //----------------------------------------------------
            $this->CI->load->model('Model_user');
            $this->CI->load->model('User_community');
            $this->CI->load->model('Model_community');
            $this->CI->load->model('Institution');
            $this->CI->load->model('Field');
            $this->CI->load->library('util');
            
            $allCommunities = array();
            $allFields = array();
            $allInstitution = array();
            $limit = 10;
            $this->currentUser = $this->CI->Model_user->GetLoggedInUsername();
            if($this->currentUser!==FALSE){
                $allCommunities = $this->CI->User_community->GetByUserName($this->currentUser,"",0,$limit);
                $allFields = $this->CI->Field->GetByUserName($this->currentUser);
                $allInstitution = $this->CI->Institution->GetByUserName($this->currentUser);
            }
            else{
                $allCommunities = $this->CI->Model_community->GetByType('groups',$limit);
                $allFields = $this->CI->Field->GetAllPublic();
            }
            $this->allCommunities = $allCommunities;
            $this->allFields = $allFields;
            $this->allInstitution = $allInstitution;


            $comLinks = array();
            foreach($allCommunities as $aCommunity){
                $comLinks[$aCommunity->name] = site_url('community').'/'.$aCommunity->community_id;
            }
            $insLinks = array();
            foreach($allInstitution as $aIns){
                $insLinks[$aIns->short_name] = site_url('institute').'/view/'.$aIns->institution_id;
            }
            $fieldsLinks =array();
            foreach($allFields as $aField){
                $fieldsLinks[$aField->short_name] = site_url('fields').'/view/'.$aField->field_id;
            }
            $nav2 = array();
            $nav2EntryHeader1 = array("Home", base_url());
            $nav2EntryHeader2 = array( "Communities", "community/index/");
            $nav2EntryHeader3 = array("Institutions", "institute/index");
            $nav2EntryHeader4 = array( "Fields", "fields/index");

            $nav2EntryDropDown1 = array();
            $nav2EntryDropDown2 = $comLinks;
            $nav2EntryDropDown3 = $insLinks;
            $nav2EntryDropDown4 = $fieldsLinks;

            $nav2[0] = array($nav2EntryHeader1,$nav2EntryDropDown1);
            $nav2[1] = array($nav2EntryHeader2,$nav2EntryDropDown2);
            $nav2[2] = array($nav2EntryHeader3,$nav2EntryDropDown3);
            $nav2[3] = array($nav2EntryHeader4,$nav2EntryDropDown4);

            $this->nav2 = $nav2;
        //---------------------------------------------
//        $this->nav2 = array(
//            array(
//                  array(
//                        "Home", base_url()
//                       )
//                ),
//            array(
//                array(
//                      "Communities", "community/index"
//                    ),
//                    array(
//                        "CSE" => "community/index/cse",
//                        "EEE" => "community/index/eee",
//                        "MME" => "community/index/mme"
//                    )
//                ),
//            array(
//                array(
//                       "Institutions", "institute/index"
//                    ),
//                    array(
//                        "BUET" => "community/buet",
//                        "DU" => "community/du",
//                        "DMC" => "community/dmc"
//                    )
//                )
//        );
    }

    function set($array, $type='css'){       
        if($type=='css'){
            $this->cssArr = array_merge($this->cssArr ,$array);
        }else if($type == "js"){
            $this->jsArr = array_merge($this->jsArr,$array);
        }        
    }

    function get($type="css",$default=false){       
        $html = "<!-- Inserting $type -->";
        if($type == "css"){
            $arr = ($default)?($this->defaultCssArr):($this->cssArr);
            foreach ($arr as $i){
                $html .= '<link rel="stylesheet" type="text/css" media="screen,projection,print" href="' . base_url() . $this->cssjsDir . $this->theme . "css/" . $i . '.css" />';
            }
        }else if($type == "js"){
            $arr = ($default)?($this->defaultJsArr):($this->jsArr);
            foreach ($arr as $i){
                $html .= '<script src = "' . base_url() . $this->cssjsDir . $this->theme . "js/" . $i . '.js"></script>';
            }
        }
        return $html;
    }

    function img($src,$w='', $h = '', $alt='Image!'){
        return "<img width = '$w' height = '$h' alt = '$alt' src = '" . base_url() . $this->cssjsDir . $this->theme . "img/" . "$src' />";
    }



    function loadViews($left_sidebar = null, $content = null, $right_sidebar = null){
        if( !isset($left_sidebar) && !isset($right_sidebar)){
            // Only Middle Sidebar present!
            // Set CSS
            $this->set(array('layout1_setup', 'layout1_text'),'css');
            // Load actual views
            $this->CI->load->view($this->theme . "general/header");
            $this->CI->load->view($this->theme . "general/content",array('content' => $content));
            $this->CI->load->view($this->theme . "general/footer");

        }else{
            // Either one or both sidebar present.
            // Set CSS
            $this->set(array('layout_setup', 'layout_text'),'css');
            // Load actual views
            $this->CI->load->view($this->theme . "general/header");
            $this->CI->load->view($this->theme . "general/left_sidebar", array('sidebars' => $left_sidebar));
            $this->CI->load->view($this->theme . "general/content",array('content' => $content));
            $this->CI->load->view($this->theme . "general/right_sidebar",array('sidebars' => $right_sidebar));
            $this->CI->load->view($this->theme . "general/footer");
        }
    }

    function showMessage($content){
       // Set CSS
        $this->set(array('layout1_setup', 'layout1_text'),'css');
        // Load actual views
        if(isset($_SERVER['HTTP_REFERER']))
            if($_SERVER['HTTP_REFERER']){
                $content = "
                    <b>$content</b>
                    <br /><br /><br /><br />

                    <div style = 'display:block' id = 'taker'><i>Taking you to previous page...</i></div>

                    <script>
                        function takeMeBack(){
                            window.location = '" . $_SERVER['HTTP_REFERER'] ."';
                        }
                        setTimeout('takeMeBack();',3000);

                        //design

                        function blinker(){
                            if($('#taker').css('display') == 'block'){
                                $('#taker').fadeOut('slow');
                            }else{
                                $('#taker').fadeIn('slow');
                            }

                            setTimeout('blinker();', 1500);
                        }

                        blinker();
                    </script>

                    ";
            }
        $this->CI->load->view($this->theme . "general/header");
        $this->CI->load->view($this->theme . "general/content",array('html' => "<div style = 'font-size:18px;' align = 'center'>$content</div>"));
        $this->CI->load->view($this->theme . "general/footer");
    }
}
?>
