<?php //foreach ($news as $row): ?>
<!--    <h3><a href=#><?= $row->heading ?></a></h3>
    <p><?= $row->content ?></p>
    <h3><?= $this->util->FormatMySqlDateTime($row->date_time) ?><br/> By <?= $row->publisher_name ?></h3>
-->

<?php //endforeach; ?>


<?php foreach ($news as $row): ?>
    <div id= 'event-<?= $row->news_id ?>' class="events" style="padding:4px;margin: 4px">
        <h2><a><?= ucfirst($row->heading) ?></a></h2>
        <br/>
        <div style="color:black;margin:2px;padding:2px;font-family:verdana,arial,sans-serif;font-size:8pt;">
            <?= ucfirst($row->content) ?>
        </div>
        <br/>
        <span style="font-size:8pt">Schedule Time:</span>
        <br/><br/>
        <span style="color:darkgreen;">
            <?=
               $this->util->FormatMySqlDateTime($row->date_time)
            ?>
        </span>
        <br/><br/> By <a href="<?= site_url("profile") . "/index/$row->publisher_name" ?>"><?= $row->publisher_name ?></a>
    </div>



<?php endforeach; ?>