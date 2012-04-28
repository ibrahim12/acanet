<dl class="nav3-grid">
    <?php
        foreach($allInstitution as $anInstitution)
        {
            echo "<dt>
                    <a href='".site_url('institute')."/view/$anInstitution->institution_id'>
                        $anInstitution->short_name
                    </a>
                </dt>";
        }
    ?>
</dl>