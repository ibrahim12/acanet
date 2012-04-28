<div class="subcontent-unit-border">
                        <div class="round-border-topleft"></div><div class="round-border-topright"></div>
                        <h1><?php echo $title; ?></h1>
                        
                        <?php
                            $this->load->view($this->page->theme . "$file",$params);
                        ?>
</div>
