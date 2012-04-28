

$(document).ready(function(){
  // alert("ready");
   $(".long").fadeOut(1);
  
   $("#Username_button").click(function(){
      $("#Username_short").fadeToggle("slow");
          $("#Username_long").fadeToggle("slow");
     
    });
   $("#Name_button").click(function(){
 
         $("#Name_short").fadeToggle("slow",function(){
            $("#Name_long").fadeToggle("slow");
       });
   });
    $("#Name_button1").click(function(){

         $("#Name_long").fadeToggle("slow",function(){
            $("#Name_short").fadeToggle("slow");
       });
   });
   $("#Address_button").click(function(){
         $("#Address_short").fadeToggle("slow",function(){
            $("#Address_long").fadeToggle("slow");
       });
   });
    $("#Address_button1").click(function(){
         $("#Address_long").fadeToggle("slow",function(){
            $("#Address_short").fadeToggle("slow");
       });
   });
   $("#Contact_number_button").click(function(){
         $("#Contact_number_short").fadeToggle("slow",function(){
            $("#Contact_number_long").fadeToggle("slow");
       });
   });
    $("#Contact_number_button1").click(function(){
         $("#Contact_number_long").fadeToggle("slow",function(){
            $("#Contact_number_short").fadeToggle("slow");
       });
   });
   $("#Mail_address_button").click(function(){
         $("#Mail_address_short").fadeToggle("slow",function(){
            $("#Mail_address_long").fadeToggle("slow");
       });
   });
    $("#Mail_address_button1").click(function(){
         $("#Mail_address_long").fadeToggle("slow",function(){
            $("#Mail_address_short").fadeToggle("slow");
       });
   });


});