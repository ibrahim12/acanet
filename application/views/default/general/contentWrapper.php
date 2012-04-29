<?php if($title != null): ?>
    <h1 class="pagetitle"><?php echo $title; ?></h1>
<?php endif ?>
                    
<?php
    $this->load->view($this->page->theme . $file, $params);
?>


                   