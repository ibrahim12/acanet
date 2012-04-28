<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!--CREATE EVENT-->
   <div class="contactform">
      <?php  echo form_open('make_event',array('id'=>'createEventForm')); ?>
         <fieldset><legend>&nbsp;CREATE EVENT&nbsp;</legend>
            <p><label for="contact_event_name" class="left">Event Name:</label>
               <input type="text" name="contact_event_name" id="contact_event_name" class="field" value="" tabindex="4" /></p>
            <p><label for="contact_event_start_date2" class="left">Start date:</label>
               <input type="text" name="contact_event_start_date" id="contact_event_start_date" class="field" value="" tabindex="4" readonly='true' /></p>
            <p><label for="contact_event_end_date" class="left">End date:</label>
               <input type="text" name="contact_event_end_date" id="contact_event_end_date" class="field" value="" tabindex="4" /></p>
            <p><label for="contact_event_desc" class="left">Description:</label>
               <textarea name="contact_event_desc" id="contact_event_desc" cols="45" rows="10"tabindex="5"></textarea></p>
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
         </fieldset>
      </form>
   </div>

<!--END OF CREATE EVENT-->