/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    $("#contact_institution").change(function(){
      
       // alert(site_url() + "/inst_field/index/" +$("#contact_institution").val())
       $("#contact_field").html("<option>Loading...</option>");

       $("#contact_field").load(site_url() + "/inst_field/index/" +$("#contact_institution").val() ,function(){
         //  alert("load is successful")
       })
    })

});


