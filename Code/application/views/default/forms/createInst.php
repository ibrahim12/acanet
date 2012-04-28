<div class="column1-unit">

      <?php
          echo validation_errors();
          echo form_open('institute/create/process');

//          // generate table
          $this->table->clear();
          $data = array();

          $data[] = array("Name", form_input("name", set_value("name")));
          $data[] = array("Short Name", form_input("sname", set_value("sname")));
          $data[] = array("Location", form_textarea(array(
              "name" => "location", "value" => set_value("location"), "cols" => "22", "rows" => "4"
          )));
          $data[] = array("Campuses", form_textarea(array(
              "name" => "campuses", "value" => set_value("campuses"), "cols" => "22", "rows" => "8"
          )));
          $data[] = array("Short Description", form_textarea(array(
              "name" => "short_description", "value" => set_value("short_description"), "cols" => "22", "rows" => "4"
          )));
          echo $this->table->generate($data);

//          echo form_label("Name: ","name");
//          echo form_input("name", set_value("name"));
//
//          echo form_label("Campuses: ", "campuses");
//          echo form_textarea("campuses", set_value("campuses"));
      ?>
      <br />
      <div align ="center">
          <input type="submit" value="Create New Institution!" />
      </div>
</div>
<hr class="clear-contentunit" />