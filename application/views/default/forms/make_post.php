         
        <?php  echo form_open('make_post',array('id'=>'makePostForm')); ?>
            <fieldset><legend>&nbsp;MAKE A POST&nbsp;</legend>
               
               <p><label for="contact_title" class="left error post-status"></label>
                  </p>
               <p><label for="contact_title" class="left">Title:</label>
                  <input type="text" name="make-post-title" id="make-post-title" class="field" value="" tabindex="1" /></p>
               <p>
                  <label for="Message" class="left">Message:</label>
                  <textarea name="contact_message" id="post-body" cols="45" rows="10"></textarea></p>
               <p><label for="Type" class="left">Type:</label>
                  <select name="make-post-community-type" class="combo select-community-type" >
                     <option value="institution">Institution</option>
                     <option value="field">Field</option>
                     <option value="course">Course</option>
                     <option value="subject">Subject</option>
                     <option value="group">Group</option>
                  </select>
               </p>
               <p><label for="Communities" class="left">Community: </label>
                  <select name="make-post-community-id" class="combo select-community-id">
                     <option>Select Type</option>
                  </select></p>
               <p><input type="hidden" name="publisherName" class="make-post-publisher-name" value="<?=$username ?>" />
                  <input type="submit" name="submit" id="makePostButton" class="button" value="Post" tabindex="6" /></p>
            </fieldset>
         </form>