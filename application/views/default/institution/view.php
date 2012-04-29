<p class="right">
    <a href="<?php echo site_url('institute/view/' . $instData->institution_id . '/community'); ?>">Go to community of this institute</a>
    <br />
    <?php echo anchor('institute/pendingMembers/list/' . $instData->institution_id, "Approve Pending Members"); ?>
    
</p>

                    <!-- Content unit - One column -->
                    <h1 class="block">Information</h1>

                    <div class="column1-unit">
                        <table>
                            <tr><th scope="row" style="width:100px;">Name</th><td><?php echo $instData->name; ?></td></tr>
                     
                            <tr><th scope="row">Institute</th><td><?php echo $instData->short_name; ?></td></tr>
                            <tr><th scope="row">Address</th><td><?php echo $instData->location; ?></td></tr>

                        </table>
                    </div>
                    <hr class="clear-contentunit" />



                    <h1 class="block">Fields</h1>
                    <div class="column1-unit">
                        <p><ul>
                                <?php
                                    if(isset($fieldsData)){
                                        foreach($fieldsData as $row){
                                            $link = site_url('fields/view') . "/" . $row['field_id'];
                                            echo "<li><a href = '$link'>" . $row['short_name'] . "</a></li>";
                                        }
                                    }
                                ?>
                            </ul></p>
                    </div>


                    <h1 class="block">News</h1>
                    <div class="column1-unit">
                        <div class="column1-unit">
                            <?php
                                foreach($newsData as $row){
                                    $title = anchor('#', $row->heading);
                                    echo "<h1>" . $title . "</h1>";
                                    $publisher = anchor('#', $row->publisher_name);
                                    echo "<h3>Published at " . $row->date_time . " by $publisher_name" . "</h3>";
                                    echo "<p>" . $row->content . "</p>";
                                }
                            ?>
                            
                        </div>
                        <hr class="clear-contentunit" />
                        <hr class="clear-contentunit" />

                    </div>
                    <h1 class="block">Events</h1>
                    <div class="column1-unit">
                        <div class="column1-unit">
                            <?php
                                foreach($eventsData as $row){
                                    $title = anchor('#', $row->title);
                                    echo "<h1>" . $title . "</h1>";
                                    $publisher = anchor('#', $row->publisher_name);
                                    echo "<h3>From " . $row->start_date_time . " to " . $row->end_date_time . " by $publisher" . "</h3>";
                                    echo "<p>" . $row->description . "</p>";
                                }
                            ?>
                        </div>
                        <hr class="clear-contentunit" />
                        <hr class="clear-contentunit" />
                    </div>