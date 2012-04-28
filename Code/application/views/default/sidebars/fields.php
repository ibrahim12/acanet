<dl class="nav3-grid">
    <?php
        foreach($allFields as $aFields)
        {
            echo "<dt>
                    <a href='".site_url('fields')."/view/$aFields->field_id'>
                        $aFields->short_name
                    </a>
                </dt>";
        }
    ?>
</dl>