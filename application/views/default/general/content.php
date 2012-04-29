                <!-- B.1 MAIN CONTENT -->
                <div class="main-content">

                    <?php
                        if(isset($html))
                            echo $html;
                        else if(isset($content)){
                            foreach ($content as $i){
                                $params = (isset($i[2]))?($i[2]):(array());
                                
                                $this->load->view($this->page->theme . 'general/contentWrapper' ,
                                        array('title' => $i[0],
                                            'file' => $i[1],
                                            'params' => $params));
                            }
                        }
                    ?>
<!--                    <hr class="clear-contentunit" />-->

                    <!-- Content unit - Two columns -->


                </div>