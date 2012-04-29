<p class="right">
    <a href="<?php echo site_url('fields/view/' . $fieldData->field_id . '/community'); ?>">Go to community of this field</a>
    <br />
    <?php echo anchor('fields/pendingMembers/list/' . $fieldData->field_id, "Approve Pending Members"); ?>
    
</p>

                    <!-- Content unit - One column -->
                    <h1 class="block">Information</h1>

                    <div class="column1-unit">
                        <table>
                            <tr><th scope="row" style="width:100px;">Name</th><td><?php echo $fieldData->name; ?></td></tr>
                     
                            <tr><th scope="row">Institute</th><td><?php echo $fieldData->short_name; ?></td></tr>

                        </table>
                    </div>
                    <hr class="clear-contentunit" />


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