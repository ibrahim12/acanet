 


<div class="column1-unit">
    <div class="contactform">

        <?php
        echo validation_errors();
        echo form_open('register'); ?>
        <fieldset><legend>&nbsp;CONTACT DETAILS&nbsp;</legend>


            <p><label for="contact_firstname" class="left">First name:</label>
                <input type="text" name="contact_firstname" id="contact_firstname" class="field" value="<?php echo set_value('contact_firstname'); ?>" tabindex="1" /></p>

            <p><label for="contact_lastname" class="left">Last name:</label>
                <input type="text" name="contact_lastname" id="contact_lastname" class="field" value="<?php echo set_value('contact_lastname'); ?>" tabindex="1" /></p>

            <p><label for="contact_username" class="left">Username:</label>
                <input type="text" name="contact_username" id="contact_username" class="field" value="<?php echo set_value('contact_username'); ?>" tabindex="1" /></p>

            <p><label for="contact_password" class="left">Password:</label>
                <input type="password" name="contact_password" id="contact_password" class="field" value="<?php echo set_value('contact_password'); ?>" tabindex="1" /></p>

            <p><label for="contact_repassword" class="left">Re Enter Password:</label>
                <input type="password" name="contact_repassword" id="contact_repassword" class="field" value="<?php echo set_value('contact_repassword'); ?>" tabindex="1" /></p>
<!--            <p><label for="contact_institution" class="left">Institution:</label>
                <select name="contact_institution" id="contact_institution" class="combo">
                    <option value="Choose">Select...</option> -->
                    <?php
                    //foreach ($inst_list as $name) {
                    //    echo "<option value =\"" . $name['institution_id'] . "\">" . $name['short_name'] . "</option>";
                    //}
                    ?>
               <!-- </select></p> -->

            <!--<p><label for="contact_field" class="left">Field:</label>
                <select name="contact_field" id="contact_field" class="combo">
                    <option value="Choose">Select...</option>


                </select></p> -->

            <p><label for="contact_address" class="left">Address :</label>

                <input type="text" name="contact_address" id="contact_address" class="field" value="<?php echo set_value('contact_address'); ?>" tabindex="1" /></p>

            <p><label for="contact_phone" class="left">Phone:</label>

                <input type="text" name="contact_phone" id="contact_phone" class="field" value="<?php echo set_value('contact_phone'); ?>" tabindex="2" /></p>
            <p><label for="contact_email" class="left">Email:</label>
                <input type="text" name="contact_email" id="contact_email" class="field" value="<?php echo set_value('contact_email'); ?>" tabindex="2" /></p>
            <p><label for="contact_url" class="left">Website:</label>
                <input type="text" name="contact_url" id="contact_url" class="field" value="<?php echo set_value('contact_url'); ?>" tabindex="3" /></p>
            <p><input type="submit" name="submit" id="submit" class="button" value="Submit" tabindex="6" /></p>
        </fieldset>

        </form>
    </div>
</div>
<hr class="clear-contentunit" />