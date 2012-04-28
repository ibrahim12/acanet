<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!--CREATE NEWS-->
   <div class="contactform">
     <?php  echo form_open('make_news',array('id'=>'createNewsForm')); ?>
         <fieldset><legend>&nbsp;CREATE NEWS&nbsp;</legend>
            <p><label for="contact_event_name" class="left">Title:</label>
               <input type="text" name="contact_news_name" id="contact_news_name" class="field" value="" tabindex="4" /></p>
            <p><label for="contact_news_desc" class="left">Description:</label>
               <textarea name="contact_news_desc" id="contact_news_desc" cols="45" rows="10"tabindex="5"></textarea></p>
            <p><label for="Type" class="left">Type:</label>
                  <select name="make-news-community-type" id="make-news-community-type" class="combo">
                     <option>Institution</option>
                     <option>Field</option>
                     <option>Course</option>
                     <option>Subject</option>
                  </select>
               </p>
               <p><label for="Communities" class="left">Community: </label>
                  <select name="make-news-community-id" id="make-news-community-id" class="combo">
                     <option>Select Type</option>
                  </select></p>
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
         </fieldset>
      </form>
   </div>

<!--END OF CREATE NEWS-->