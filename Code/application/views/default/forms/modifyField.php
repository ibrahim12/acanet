<div class="column1-unit">

      <?php
          echo validation_errors();
          echo form_open('fields/create/process/modify','',array('field_id' => $fieldData->field_id));

//          // generate table
          $this->table->clear();
          $data = array();

          $data[] = array("Name", form_input("name", $fieldData->name));
          $data[] = array("Short Name", form_input("short_name", $fieldData->short_name));
          
          $data[] = array("Institution", form_dropdown('institution_id',$instList, $fieldData->institution_id) );
          
          $data[] = array("Short Description", form_textarea(array(
              "name" => "short_description", "value" => $fieldData->short_description, "cols" => "22", "rows" => "4"
          )));
          // Only admin can update status! (following line)
          $data[] = array("Status", form_dropdown('status', array(
              'approved' => 'Approved',
              'pending' => 'Pending'
          ), $fieldData->status) . " (" . $fieldData->status . ") ");
          echo $this->table->generate($data);

//          echo form_label("Name: ","name");
//          echo form_input("name", set_value("name"));
//
//          echo form_label("Campuses: ", "campuses");
//          echo form_textarea("campuses", set_value("campuses"));
      ?>
      <br />
      <div align ="center">
          <input type="submit" value="Update Field!" />
      </div>
</div>
<hr class="clear-contentunit" />