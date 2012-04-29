
    <div id="content_detail">
        <h1 class="block">Contents</h1>
        <br/>
        <table>
            <tr>
                <th class="top" scope="col" style="width:100px;">Name</th>
                <th class="top" scope="col" style="width:100px;">Uploader</th>
                <th class="top" scope="col">Date</th>
            </tr>
            <?php foreach ($allContent as $row): ?>
                 <tr><th scope="row">
                       <a href="<?=$row->content_link ?>">
                            <?php echo $row->description; ?>
                       </a>
                </th>
                <td><?php echo $row->publisher_name; ?></td>
                <td><?php echo $this->util->FormatMySqlDateTime($row->date_time) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
