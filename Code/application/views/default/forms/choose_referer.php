<?php
    if(!isset($id) || !isset($controller)){
        echo "First choose the ID/controller of the institutiuon";
        exit();
    }
?>

<br />
To access this community, someone should refer you. Put in the following box username of someone 
who will verify your access to this community. The person who you want as referer should already be a member
of this community.

<br /><br />
However, if you don't know anyone, leave the box empty. Your request will appear on the 
community and anyone who knows you can grant your access.

<br />

<div class="column1-unit">
   <div class="contactform">

      <?php
      //print_r($inst_list);
      
      echo validation_errors();
      echo form_open("$controller/join/ref_chosen/$id", '', array('id' => $id)); ?>
      <fieldset><legend>&nbsp;Choose A Referer&nbsp;</legend>

         
         <p><label for="referer" class="left">Referer Username</label>
            <input type="text" name="referer" id="referer" class="field" value="<?php echo set_value('referer'); ?>" tabindex="1" /></p>
         
         
      </fieldset>
      <br />
      <div align="center">
        <input type="submit" value="Request Approval!" />
        <br />
      </div>
      </form>
   </div>
</div>
<hr class="clear-contentunit" />