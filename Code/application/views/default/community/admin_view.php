

<div id="post_detail">
    <h1 class="block">Members</h1>

    <?php foreach ($member as $row): ?>
        <div class="column1-unit">
            <h1><?= $row->title ?></h1>
            <h3><?= $row->date_time ?>, by <a href="#"><?= $row->publisher_name ?> </a></h3>
            <p><?= $row->description ?></p>
            <p class="details"><a href="#">Details</a> | Comments: <a href="#">73</a> </p>
        </div>
        <hr class="clear-contentunit" />
    <?php endforeach; ?>
</div>
