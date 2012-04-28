
<?php foreach ($links as $row): ?>
    <h3><a href=#><?= $row->title ?></a> </h3>
    <p><?= $row->description ?></p>
    <h3>Start:<br/> <?= $row->start_date_time ?><br/> End:<br/> <?= $row->end_date_time ?></h3>


<?php endforeach; ?> 