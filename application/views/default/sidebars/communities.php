<dl class="nav3-grid">
    <?php
        foreach($allCommunities as $aCommnity)
        {
            echo "<dt>
                    <a href='".site_url('community')."/index/$aCommnity->community_id'>
                        $aCommnity->name
                    </a>
                </dt>";
        }
    ?>
</dl>