<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Request extends CI_Model {

     // I don't see the necessary of this table.
     // Using the user_institution table will do. 

        var $request_id;
        var $description;
        var $type;
        var $sender_name;
        var $referer_name;
        var $community_id;
        var $status;

        function __construct(){
            // Call the Model constructor
            parent::__construct();
        }

        function Insert(){

        }

   }

?>