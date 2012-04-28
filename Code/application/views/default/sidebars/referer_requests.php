<?php

/* * ***** ****** ****** ****** ****** ******
 *
 * Author       :   Shafiul Azam
 *              :   ishafiul@gmail.com
 *              :   Project Manager
 * Page         :
 * Description  :   
 * Last Updated :
 *
 * ****** ****** ****** ****** ****** ***** */


echo "<ul>";

if(isset($instData)){
   foreach($instData as $row){
        echo "<li>" . $row->username . " wants to join Institution " . anchor("institute/view/" . $row->institution_id,$row->short_name) . " , " . anchor('institute/pendingMembers/approve/' . $row->institution_id . "/" . $row->username . "/member", "Approve") .
                " or " .anchor('institute/pendingMembers/approve/' . $row->institution_id . "/" . $row->username . "/banned", "Reject") ."</li>";
    } 
}


if(isset($fieldData)){
   foreach($fieldData as $row){
        echo "<li>" . $row->username . " wants to join Field " . anchor("fields/view/" . $row->field_id,$row->short_name) . " , " . anchor('fields/pendingMembers/approve/' . $row->field_id . "/" . $row->username . "/member", "Approve") .
                " or " .anchor('fields/pendingMembers/approve/' . $row->field_id . "/" . $row->username . "/banned", "Reject") ."</li>";
    } 
}



echo "</ul>";

?>
