

    <h1 class="block">Members</h1>

    <div class="column1-unit">
        <table>
            <tr>
                <th class="top" scope="col" style="width:200px;">Usename</th>
            </tr>
            <?php foreach ($members as $row): ?>
                <tr><th scope="row"><?php echo $row->username; ?></th></tr>
            <?php endforeach; ?>
        </table>
    </div>

