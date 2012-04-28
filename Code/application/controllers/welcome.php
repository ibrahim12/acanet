<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index(){
            $this->page->title = "Welcome to AcaNet";

            $this->page->loadViews(
                    null,
                    array(
                        array("Log in please!", "forms/login")
                    ),
                    null);
	}

        function registration(){
            

            $this->page->title = "Registration";


            $this->page->loadViews(
                    array(
                        array('Dummy 1', "sidebars/dummyList"),
                        array('Dummy 2', "sidebars/dummyList")
                    ),
                    array(
                        array("Registration", "forms/registration")
                    ),
                    array(
                        array("Login Side", "forms/login"),
                        array("Events", "sidebars/events"),
                        array("News", "sidebars/news")
                    ));
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */