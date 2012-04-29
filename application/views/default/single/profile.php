<!-- B.1 MAIN CONTENT -->

<!-- Pagetitle -->        
<!-- Content unit - One column -->
<?php
//function CheckForm($form_id, $default, $inverted) {
//    global $form_open;
//    if ($form_open != $form_id)
//        echo "class=\"$default\"";
//    else
//        echo "class=\"$inverted\"";
//}
//print_r($user_data);
//echo gettype($form_open);

//$this->util->FreshPrint($user_data['privacy']);
?>
<h1 class="block">Personal Informations</h1>
<div class="column1-unit" style="min-height: 260px;">
    <!--   <div id = "Username">
        <div id="Username_short" class="short">
            Username : <?php echo $user_data['username'] ?><br/>
            <button id="Username_button">Change</button>
        </div>
        <div id="Username_long" class="long">

        </div>


    </div>
    -->
   

    <div id = "Name">
        <div id="Name_short" <?php if ($form_open != "2") echo "class=\"short\""; else echo "class=\"long\"";?>>
            <span class="post-title">Name :</span> <span class='post-description'><?php echo $user_data['name'] ?></span><br/>
            <?php if($user_data['self'] == 1){ ?>
            <a id="Name_button" href="#">Change</a>
            <?php }?>


        </div>
        <div id="Name_long" <?php if ($form_open != "2") echo "class=\"long\""; else echo "class=\"short\"";?>>
            <?php
             if($form_open == "2")
             echo urldecode($message);
             echo form_open('profile_change/ChangeName');
            ?>
             <span class="post-title"> Your Name :</span> <span class='post-description'> <?php echo $user_data['name']; ?></span><br/> <a id="Name_button1" href="#">Cancel</a><br/>

             Preferred Name :<input type="text" name="changed_name" />
             <input type="submit" value="Submit" />
             
             </form>
         </div>


     </div>

     <div id = "Address">
         <div id="Address_short" <?php if ($form_open != "3") echo "class=\"short\""; else echo "class=\"long\"";?>>
             <span class="post-title">Address :</span> <span class='post-description'> <?php echo $user_data['address'] ?></span><br/>
              <?php if($user_data['self'] == 1){ ?>
             <a id="Address_button" href="#">Change</a>
             <?php }?>
         </div>
          <div id="Address_long" <?php if ($form_open != "3") echo "class=\"long\""; else echo "class=\"short\"";?>>
            <?php
            if($form_open == "3")
             echo urldecode($message);
             echo form_open('profile_change/ChangeAddress');
            ?>
             Your Address : <?php echo $user_data['address']; ?> <br/> <a id="Address_button1" href="#">Cancel</a><br/>

             Preferred Address : <input type="text" name="changed_address" />
             <input type="submit" value="Submit" />

             </form>
         </div>


     </div>
     <?php  if($user_data['self'] == 1 || $user_data['privacy'][1]==1 ): ?>
     <div id = "Contact_number">
         <div id="Contact_number_short" <?php if ($form_open != "4") echo "class=\"short\""; else echo "class=\"long\"";?>>
             <span class="post-title">Contact Number : </span> <span class='post-description'> <?php echo $user_data['contact_number'] ?></span><br/>
             <?php if($user_data['self'] == 1){ ?>
             <a id="Contact_number_button" href="#">Change</a>
             <?php }?>
         </div>
         <div id="Contact_number_long" <?php if ($form_open != "4") echo "class=\"long\""; else echo "class=\"short\"";?>>
         <?php
            if($form_open == "4")
             echo urldecode($message);
             echo form_open('profile_change/ChangeNumber');
            ?>
             Your Contact Number: <?php echo $user_data['contact_number']; ?> <br/> <a id="Contact_number_button1" href="#">Cancel</a><br/>

             Preferred Address : <input type="text" name="changed_number" />
             <input type="submit" value="Submit" />

             </form>
         </div>
     </div>
    <?php endif; ?>
       <?php  if($user_data['self'] == 1 || $user_data['privacy'][2]==1 ): ?>
     <div id = "Mail_address">
         <div id="Mail_address_short"  <?php if ($form_open != "5") echo "class=\"short\""; else echo "class=\"long\"";?>>
             <span class="post-title">Mail Address : </span> <span class='post-description'> <?php echo $user_data['mail_address'] ?></span><br/>
            <?php if($user_data['self'] == 1){ ?>
             <a id="Mail_address_button" href="#">Change</a>
             <?php }?>
        </div>
        <div id="Mail_address_long" <?php if ($form_open != "5") echo "class=\"long\""; else echo "class=\"short\"";?>>
        <?php
            if($form_open == "4")
             echo urldecode($message);
             echo form_open('profile_change/ChangeMailAddress');
             ?>
             Your Mail Address : <?php echo $user_data['mail_address']; ?> <br/> <a id="Mail_address_button1" href="#">Cancel</a><br/>

             Preferred Mail Address : <input type="text" name="changed_mail_address" />
             <input type="submit" value="Submit" />

        </form>
           
        </div>
    </div>
   <?php endif ?>
    </div>
    <hr class="clear-contentunit" />
    <?php  if($user_data['self'] == 1): ?>
    <h1 class="block">Privacy Settings</h1>
    <div class="column1-unit">
        <?php    echo form_open('profile_change/updatePrivacy'); ?>
        <table>
            <tr><td>Receive Email Notification</td><td style="width:30px;">
                    <input <?php if($user_data['privacy'][0]==1)echo "checked";else echo ""; ?> name="privacy[0]" value="1" type="checkbox"/></td></tr>
            <tr><td>Hide Phone Number</td><td>
                    <input <?php if($user_data['privacy'][1]==1)echo "checked";else echo ""; ?> name="privacy[1]" value="1" type="checkbox"/></td></tr>
            <tr><td>Hide Email</td><td>
                    <input <?php if($user_data['privacy'][2]==1)echo "checked";else echo ""; ?> name="privacy[2]" value="1" type="checkbox"/></td></tr>
            <tr><td>Receive Notification Update</td><td>
                    <input <?php if($user_data['privacy'][3]==1)echo "checked";else echo ""; ?> value="1" name="privacy[3]" type="checkbox"/></td></tr>
            <tr><td><input type="submit" id="changePrivacy" value="change"></td></tr>
        </table>
       </form>
    </div>
    <?php endif ?>
    <hr class="clear-contentunit" />

