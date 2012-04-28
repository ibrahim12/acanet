<?php
   $data = "";
   foreach ($allCommunity as $anComunity) {
      $data .="<option value='{$anComunity->community_id}'>" .
              trim($anComunity->name)
              . "</optoin>";
   }
   echo $data;
?>
