<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * What does this file do? not written by me... - shafiul
 */

class Inst_field extends CI_Controller {

    // public $CI;

    function __construct() {
        parent::__construct();
    }

    function index($inst_id) {
        $this->load->model('Institution');
        $this->load->model('Field');
        $list = $this->Field->GetFieldByInst($inst_id);
        foreach ($list as $element) {
            echo "<option value='" . $element['field_id'] . "'>" . $element['short_name'] . "</option>";
        }
    }

}
?>