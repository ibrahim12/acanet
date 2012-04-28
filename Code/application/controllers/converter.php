<?php
/***********************************************
 * Author: Tarequl Islam Sifat
 * *********************************************
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Converter extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($community_id) {
        $this->load->model('Model_community');
        $community = $this->Model_community->GetById($community_id);
        if ($community == null) {
            redirect(site_url("/community_list"));
        }
        $community = $community[0];
        $community_id = $community->community_id;
            $parentId = $this->Model_community->GetInstId($community_id);
            if($parentId){
             $parentId = $parentId[0];
             redirect(site_url('/institute/join/id_chosen/' . $parentId->institution_id));
            }
            $parentId = $this->Model_community->GetFieldId($community_id);
            if($parentId){
             $parentId = $parentId[0];
             redirect(site_url('/fields/join/id_chosen/' . $parentId->field_id));
            }

            $this->page->showMessage("Institution or Field not found!");
            

        
    }

}
?>