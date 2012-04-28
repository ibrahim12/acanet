<?php

    /* ****** ****** ****** ****** ****** ******
    *
    * Author       :   Shafiul Azam
    *              :   ishafiul@gmail.com
    *              :   Core Developer, PROGmaatic Developer Network
    *              :   shafiul.user.sf.net
    * Page         :
    * Description  :   
    * Last Updated :
    *
    * ****** ****** ****** ****** ****** ******/

    // View for joining One.
    if(isset($list)){

        if(!isset($action))
            $action = "join";

        $this->table->clear();
        $data = array();
        $data[] = array("Name", "Institution Name", "Description", "Status", "Action");
        foreach($list as $i){
            $actionText = anchor('fields/join/id_chosen/' . $i->field_id, "Join!");
            if($action == "modify")
                $actionText = anchor('fields/modify/id_chosen/' . $i->field_id, "Modify");
            
            $data[] = array(anchor('fields/view/' . $i->field_id, $i->name), $i->institution_id, $i->short_description,
                $i->status, $actionText);
        }
        echo $this->table->generate($data);
    }else{
        echo "Nothing to display.";
    }
?>
