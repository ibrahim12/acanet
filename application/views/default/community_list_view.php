<?php

function isJoinedAlready($communities, $community_id) {
    foreach ($communities as $row) {
        if ($row->community_id == $community_id) {
            return true;
        }
    }
    return false;
}
?>

<!-- Content unit - One column -->
<h1 class="block"><?php echo $type ?> communities</h1>
<div class="column1-unit">
    <table>
        <tr>
            <th class="top" scope="col" style="width:200px;">Name</th>
            <th class="top" scope="col">Short Description</th>
            <th class="top" scope="col" style="width:130px;">Action</th>
        </tr>
        <?php foreach($query_result as $row): ?>
        <tr><th scope="row">
                <a href="<?=  site_url("/community/index/$row->community_id")?>">
                    <?php echo $row->name;?>
                </a>
            </th>
            <td><?php echo $row->short_description;?></td>
            <?php

                if (isJoinedAlready($communities, $row->community_id) == false) {
                    if($type == "institution")
                        echo '<td><a href= ' . site_url('/converter/index/' . $row->community_id) . '>Join</a></td>';
                    else if($type == "field")
                        echo '<td><a href= ' . site_url('/converter/index/' . $row->community_id) . '>Join</a></td>';
                    else{
                        echo '<td><a href= ' . site_url('/joinCommunity/index/' . $row->community_id).'>Join</a></td>';
                    }
                } else {
                    echo '<td>Already Joined!</td>';
                }

            ?>
        </tr>
        <?php        endforeach; ?>
    </table>
</div>
<hr class="clear-contentunit" />
