<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo " From:acanet@com </br>
       Subject: Verification link  </br>
       Thank you for registering in acanet </br>
       click on the below link for email verification </br>
                          "."<a href='" . site_url()."/verifyuser/index/".$username."/".$param ."'>".$param."</a>";

?>
