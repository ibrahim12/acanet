<div id="jq_action_form_hide"><a href="#" ><p class="right" style="margin: 0;">hide</p></a></div>

<!--MAKE POST-->
<div class="column1-unit" id ="jq_makePost">
   <div class="contactform">
       <?php echo form_open("make_post") ?>
         <fieldset><legend>&nbsp;MAKE A POST&nbsp;</legend>
            <p><label for="contact_title" class="left">Title:</label>
               <input type="text" name="title" id="contact_title" class="field" value="" tabindex="4" /></p>
            <p><label for="contact_message" class="left">Message:</label>
               <textarea name="description" id="contact_message" cols="45" rows="10"tabindex="5"></textarea></p>
                <input type="hidden" name="cId"  class="field" value="<? echo $communityId?>" tabindex="4" />
                <input type="hidden" name="publisherName" id="loggedUsername" class="field" value="<? echo $userName?>" tabindex="4" />
<!--                 for redirect-->
                <input type="hidden" name="redirect"  class="field" value= "<?php echo "/community/index/".$community_id ;?>" tabindex="4" />
                <input type="hidden" name="type"  class="field" value= "post" tabindex="4" />
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
         </fieldset>
      <?php echo form_close()?>
   </div>
</div>
<!--END OF MAKE POST-->


<!--LINK SHARE-->
<div class="column1-unit" id ="jq_linkShare">
   <div class="contactform">
      <?echo form_open("make_link")?>
         <fieldset><legend>&nbsp;SHARE LINK&nbsp;</legend>
            <p><label for="content_link" class="left">Link:</label>
               <input type="text" name="content_link" id="content_link" class="field" value="" tabindex="4" /></p>
<!--            <p><label for="contact_link_name" class="left">Name:</label>
               <input type="text" name="contact_link_name" id="contact_link_name" class="field" value="" tabindex="4" /></p>-->
            <p><label for="content_link_desc" class="left">Description:</label>
               <textarea name="content_link_desc" id="content_link_desc" cols="45" rows="10"tabindex="5"></textarea></p>
                <input type="hidden" name="cId"  class="field" value="<? echo $communityId?>" tabindex="4" />
                <input type="hidden" name="publisherName"  class="field" value="<? echo $userName?>" tabindex="4" />
<!--                 for redirect-->
                <input type="hidden" name="redirect"  class="field" value= "<?php echo "/community/index/".$community_id ;?>" tabindex="4" />
                <input type="hidden" name="type"  class="field" value= "post" tabindex="4" />
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
         </fieldset>
      <?php echo form_close()?>
   </div>
</div>
<!--END OF LINK SHARE-->

<!--CREATE EVENT-->
<div class="column1-unit" id ="jq_createEvent">
   <div class="contactform">
      <?echo form_open('make_event')?>
         <fieldset><legend>&nbsp;CREATE EVENT&nbsp;</legend>
            <p><label for="event_name" class="left">Event Name:</label>
               <input type="text" name="event_name" id="event_name" class="field" value="" tabindex="4" /></p>
            <p><label for="event_start_date" class="left">Start date:</label>
               <input type="text" name="event_start_date" id="event_start_date" class="field" value="" tabindex="4" readonly='true' /></p>
            <p><label for="event_end_date" class="left">End date:</label>
               <input type="text" name="event_end_date" id="event_end_date" class="field" value="" tabindex="4" readonly='true'  /></p>
            <p><label for="event_desc" class="left">Description:</label>
               <textarea name="event_desc" id="event_desc" cols="45" rows="10"tabindex="5"></textarea></p>
                <input type="hidden" name="cId"  class="field" value="<? echo $communityId?>" tabindex="4" />
                <input type="hidden" name="publisherName"  class="field" value="<? echo $userName?>" tabindex="4" />
<!--                 for redirect-->
                <input type="hidden" name="redirect"  class="field" value= "<?php echo "/community/index/".$community_id ;?>" tabindex="4" />
                <input type="hidden" name="type"  class="field" value= "post" tabindex="4" />
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
         </fieldset>
      <?php echo form_close()?>
   </div>
</div>
<!--END OF CREATE EVENT-->


<!--CREATE NEWS-->
<div class="column1-unit" id ="jq_createNews">
   <div class="contactform">
      <?echo form_open('make_news')?>
         <fieldset><legend>&nbsp;CREATE NEWS&nbsp;</legend>
            <p><label for="news_title" class="left">Title:</label>
               <input type="text" name="news_title" id="news_title" class="field" value="" tabindex="4" /></p
            <p><label for="news_type" class="left">Type:</label>
               <input type="text" name="news_type" id="news_type" class="field" value="" tabindex="4" /></p>
            <p><label for="news_desc" class="left">Description:</label>
               <textarea name="news_desc" id="news_desc" cols="45" rows="10"tabindex="5"></textarea></p>
                <input type="hidden" name="cId"  class="field" value="<? echo $communityId?>" tabindex="4" />
                <input type="hidden" name="publisherName"  class="field" value="<? echo $userName?>" tabindex="4" />
<!--                 for redirect-->
                <input type="hidden" name="redirect"  class="field" value= "<?php echo "/community/index/".$community_id ;?>" tabindex="4" />
                <input type="hidden" name="type"  class="field" value= "post" tabindex="4" />
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
         </fieldset>
      <?php echo form_close()?>
   </div>
</div>
<!--END OF CREATE NEWS-->
