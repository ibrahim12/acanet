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

$this->table->clear();

$tableData = array();

$tableData[] = array("Requesting User", "Chosen Referer", "Action");
foreach($data as $row){
    $tableData[] = array(
        $row->username,
        $row->referer,
        anchor("fields/pendingMembers/approve/$fieldId/" . $row->username . "/member","Approve") . " " .
        anchor("fields/pendingMembers/approve/$fieldId/" . $row->username . "/banned","Deny")
    );
}

echo $this->table->generate($tableData);

?>
