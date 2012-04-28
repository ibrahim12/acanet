<div class="column1-unit">

      <?php
          echo validation_errors();
          echo form_open('createCommunity/process');

          // generate table
          $this->table->clear();
          $data = array();

          $data[] = array("Name", form_input("name", set_value("name")));
          $options = array(
                  'institution'  => 'institution',
                  'subject'    => 'subject',
                  'field'   => 'field',
                  'course' => 'course',
                  'group' => 'group'
                );
          $data[] = array("Type", form_dropdown('stype', $options, 'group'));
          $data[] = array("Short Description", form_textarea(array(
              "name" => "short_description", "value" => set_value("short_description"), "cols" => "22", "rows" => "4"
          )));
          echo $this->table->generate($data);

      ?>
      <br />
      <div align ="center">
          <input type="submit" value="Create New Community" />
      </div>
</div>
<hr class="clear-contentunit" />