<!-- B.1 MAIN NAVIGATION -->
               
                <div class="main-navigation">
                    <?php                        
                        if(isset($sidebars)){
                            $isFirstSidebar = true;                            
                            foreach ($sidebars as $i){
                                $params = (isset($i[2]))?($i[2]):(array());
                                if($isFirstSidebar){
                                    echo '<div class="round-border-topright"></div>';
                                    echo "<h1 class='first'>" . $i[0] . "</h1>";
                                    $isFirstSidebar = false;
                                }else{
                                    echo "<h1>" . $i[0] . "</h1>";
                                }
                                $this->load->view($this->page->theme . $i[1],$params);
                            }
                        }else{
                            if(isset($html))
                                echo $html;
                        }
                    ?>
                    
                </div>

