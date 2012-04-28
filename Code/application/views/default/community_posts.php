<div id="recent-post-load-div">
<?php
$len = "";
$i = 0;
foreach ($allPosts as $aPost):
    $class = !($i % 2) ? "odd" : "even";
    $i++;
    $replyCount = count($aPost->replyies);
    $classHidden = ($replyCount==0)?"hidden":"";
    ?>

    <div class="post-post-reply-wrapper">
        <div class="posts <?= $class ?> rounded" postId="<?= $aPost->post_id ?>">
            <div class="post-title"><?= ucfirst($aPost->title) ?></div>
            <div class="post-datetime"><?= date_format(date_create($aPost->date_time), 'l, d F Y \a\t H:i'); ?>
            </div>
            <div class="hidden" id="complete-post-desc-<?= $aPost->post_id ?>"><?= $aPost->description ?></div>
            <div class="post-description">
                <?php
                $len = strlen($aPost->description);
                if ($len > 80)
                    echo substr($aPost->description, 0, 80);
                else
                    echo $aPost->description;
                ?>
                <a class="read-more" href="#complete-post-desc-<?= $aPost->post_id ?>">
                    <?php
                    if ($len > 80)
                        echo "Read more &raquo;";
                    ?>
                </a>

            </div>

            <p class="details">

                <br/>
                <br/>
                | Posted by <a href="<?= site_url("profile") . "/index/$aPost->publisher_name" ?>"><?= $aPost->publisher_name ?>
                </a>
                <? if($replyCount): ?>
                | Reply's: <?= $replyCount; ?>
                <? endif ?>
                | <a class="show-post-reply" href="javascript:void(0);" postId="<?= $aPost->post_id ?>">
                    <?php
                            echo ($replyCount)? "Hide replies":"Reply"
                    ?>
                </a>


            </p>
        </div>

        <div class="post-reply-wrapper <?= $classHidden; ?>" id="post-reply-wrapper-<?= $aPost->post_id ?>">
            <?php foreach($aPost->replyies as $aReply): ?>
                <div class="posts-reply">
                    <div class="post-description">
                        <?php
                        $len = strlen($aReply->description);
                        if ($len > 80)
                            echo substr($aReply->description, 0, 80);
                        else
                            echo $aReply->description;
                        ?>
                        <a class="read-more" href="javascript:void(0)">
                            <?php
                            if ($len > 80)
                                echo "Read more &raquo;";
                            ?>
                        </a>
                    </div>

                    <div class="post-datetime"><?= date_format(date_create($aReply->date_time), 'l, d F Y \a\t H:i'); ?>,
                        by <a href="<?= site_url("profile") . "/index/$aPost->publisher_name" ?>"><?= $aReply->publisher_name ?></a></div>


                </div>
            <?php endforeach; ?>

            <?php if(!$this->isPublicView):?>
            <div class="post-reply-input-div" class="contactform">
               <textarea class="field post-reply-input shadow" type="text" name="post-reply-input"  cId ="<?= $community_id ?>" postId="<?= $aPost->post_id ?>" rows="2" cols="30"></textarea>
               <div class="replySubmitButtonDiv rounded">
                   <span>Reply</span>
               </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
<?php endforeach; ?>
</div>