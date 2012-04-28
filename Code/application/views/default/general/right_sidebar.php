<!-- B.3 SUBCONTENT -->
                <div class="main-subcontent">

                   <?php
                        if(isset($sidebars)){
                            foreach ($sidebars as $i){
                                $params = (isset($i[2]))?($i[2]):(array());
                                $this->load->view($this->page->theme . 'general/right_sidebarWrapper' ,
                                        array('title' => $i[0],
                                            'file' => $i[1],
                                            'params' => $params));
                            }
                        }else{
                            if(isset($html))
                                echo $html;
                        }
                    ?>

                </div>
            
