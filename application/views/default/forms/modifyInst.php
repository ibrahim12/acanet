<div class="column1-unit">

      <?php
          echo validation_errors();
          echo form_open('institute/create/process/modify','',array('institution_id' => $instData->institution_id));

//          // generate table
          $this->table->clear();
          $data = array();

          $data[] = array("Name", form_input("name", $instData->name));
          $data[] = array("Short Name", form_input("sname", $instData->short_name));
          $data[] = array("Location", form_textarea(array(
              "name" => "location", "value" => $instData->location, "cols" => "22", "rows" => "4"
          )));
          $data[] = array("Campuses", form_textarea(array(
              "name" => "campuses", "value" => $instData->campuses, "cols" => "22", "rows" => "8"
          )));
          $data[] = array("Short Description", form_textarea(array(
              "name" => "short_description", "value" => $instData->short_description, "cols" => "22", "rows" => "4"
          )));
          // Only admin can update status! (following line)
          $data[] = array("Status", form_dropdown('status', array(
              'approved' => 'Approved',
              'pending' => 'Pending'
          ), $instData->status) . " (" . $instData->status . ") ");
          echo $this->table->generate($data);

//          echo form_label("Name: ","name");
//          echo form_input("name", set_value("name"));
//
//          echo form_label("Campuses: ", "campuses");
//          echo form_textarea("campuses", set_value("campuses"));
      ?>
      <br />
      <div align ="center">
          <input type="submit" value="Update Institution!" />
      </div>
</div>
<hr class="clear-contentunit" />