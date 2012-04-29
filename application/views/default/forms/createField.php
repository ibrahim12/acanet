<div class="column1-unit">

      <?php
            
          if(empty($institutes))
              die("No Institution data found");
          echo validation_errors();
          echo form_open('fields/create/process');

//          // generate table
          $this->table->clear();
          $data = array();

          $data[] = array("Name", form_input("name", set_value("name")));
          $data[] = array("Short Name", form_input("short_name", set_value("short_name")));
          
          $data[] = array("Institution", form_dropdown('institution_id',$institutes) );
          
          $data[] = array("Short Description", form_textarea(array(
              "name" => "short_description", "value" => set_value("short_description"), "cols" => "22", "rows" => "4"
          )));
          echo $this->table->generate($data);

      ?>
      <br />
      <div align ="center">
          <input type="submit" value="Create New Field!" />
      </div>
</div>
<hr class="clear-contentunit" />