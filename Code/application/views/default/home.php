
<div id="jq_action_form_hide"><a href="#" ><p class="right" style="margin: 0;">hide</p></a></div>

   <div class="column1-unit" id ="jq_makePost">
      <?php if($username!==false): ?>
      <div class="contactform" id="make-post-form-container">
         <?php $this->load->view($this->page->theme.'forms/make_post',array('username'=>$username)); ?>
      </div>
      <?php endif ?>
   </div>
   <div class="column1-unit" id ="jq_linkShare">
      <?php if($username!==false): ?>      
         <?php $this->load->view($this->page->theme.'forms/link_share',array('username'=>$username)); ?>      
      <?php endif ?>
   </div>
   <div class="column1-unit" id ="jq_createEvent">
      <?php if($username!==false): ?>      
         <?php $this->load->view($this->page->theme.'forms/create_event',array('username'=>$username)); ?>      
      <?php endif ?>
   </div>
   <div class="column1-unit" id ="jq_createNews">
      <?php if($username!==false): ?>      
         <?php $this->load->view($this->page->theme.'forms/create_news',array('username'=>$username)); ?>      
      <?php endif ?>
   </div>
  <input type="hidden" id="loggedUsername" name="loggedUsername" value="<? echo $username; ?>" />   

   <div class="column1-unit">
   </div>
   <div id="recent-post-load-div">
       <a class="readMore" style="display:none;"></a>
   </div>
   

<br>
   <hr class="clear-contentunit" />

 




