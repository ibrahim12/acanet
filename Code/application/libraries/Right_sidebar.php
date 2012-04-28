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



class Right_sidebar {
    //put your code here

    public $CI;

    function  __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('forms');
        $this->CI->load->library('page');
    }

    function login(){
        return $this->CI->page->rSidebarFormat("Login", $this->CI->forms->login());
    }

    function login2(){
        return $this->CI->page->rSidebarFormat("Login", "meogjbsdfdf");
    }

}
?>