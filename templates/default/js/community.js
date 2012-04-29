/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){

    //=========Date Time Picker for Event Form==================

    $('#event_start_date,#event_end_date').datetimepicker({
        showSecond: true,
        timeFormat: 'hh:mm:ss',
        dateFormat: 'yy-mm-dd',
        stepHour: 2,
        stepMinute: 10,
        stepSecond: 10
    });




    //========ACTION TABS=============================

    var init_done = false;
    var tab_no = 0;

    var actiontab = [];
    actiontab[1] = "#jq_makePost";
    actiontab[2] = "#jq_linkShare";
    actiontab[3] = "#jq_createEvent";
    actiontab[4] = "#jq_createNews";
    function hideAll(new_tab_no){
        if(tab_no == new_tab_no) return;
        if(init_done){
            $(actiontab[tab_no]).slideUp("fast");
            $("#jq_action_form_hide").hide();
        }else{

            for ( var i = 1 ; i < 5 ; i++){
                $(actiontab[i]).hide();
            }
            $("#jq_action_form_hide").hide();
            init_done = true;
        }
    }
    
    //hide button
    hideAll(-1);

   
    $("#jq_action_form_hide").click(function(){
        $(actiontab[tab_no]).slideUp("fast");
        $(this).hide();
    });

    $("#jq_tab_post").click(function(){
        hideAll(1);
        $("#jq_makePost").slideDown("fast");
        $("#jq_action_form_hide").show();
        tab_no = 1;
    });

    $("#jq_tab_link").click(function(){
        hideAll(2);
        $("#jq_linkShare").slideDown("fast");
        $("#jq_action_form_hide").show();
        tab_no = 2;
    });

    $("#jq_tab_event").click(function(){
        hideAll(3);
        $("#jq_createEvent").slideDown("fast");
        $("#jq_action_form_hide").show();
        tab_no = 3;
    });

    $("#jq_tab_news").click(function(){
        hideAll(4);
        $("#jq_createNews").slideDown("fast");
        $("#jq_action_form_hide").show();
        tab_no = 4;
    });



    //=============INFO TABS===========================

    var info_tab = [];
    info_tab[1] = "#post_detail";
    info_tab[2] = "#news_detail";
    info_tab[3] = "#event_detail";
    info_tab[4] = "#content_detail";
    info_tab[5] = "#members_detail";
    info_tab[6] = "#admins_detail";
    info_tab[7] = "#about_detail";

    var info_loaded = [];
    info_loaded[1] = true;
    info_loaded[2] = true;
    info_loaded[3] = true;
    info_loaded[4] = true;
    info_loaded[5] = true;
    info_loaded[6] = true;
    info_loaded[7] = true;


    var info_tab_no = 1;
    var info_loading = false;

    function init(){
        for ( var i = 2 ; i < 8 ; i++){
            $(info_tab[i]).css({
                opacity: 0.0
            }).hide();
        }         
    }
    init();

    function hide_n_show(new_info_tab_no)
    {
        if(new_info_tab_no == info_tab_no) return;
        if(info_loading) return;
        for(var i = 1 ; i < 8 ; i++)$(info_tab[i]).hide();

        $(info_tab[info_tab_no]).show();

        if(info_loaded[new_info_tab_no]){
            info_loading = true;
            $(info_tab[info_tab_no]).animate({
                opacity: 0.0
            },500).hide(1,function(){
                $(info_tab[new_info_tab_no]).show(1).animate({
                    opacity: 1.0
                },500,function(){
                    info_loading = false;
                });
                
            });
        }
        else{
            $(info_tab[info_tab_no]).animate({
                opacity: 0.4
            },500);
        //$.load(url, data, callback)
        }


        info_tab_no = new_info_tab_no;         //make tab = new tab
    }

    //1
    $("#jq_tab_show_post").click(function(){
        hide_n_show(1);        
    });
    
    //2
    $("#jq_tab_show_news").click(function(){
        hide_n_show(2);
    });

    //3
    $("#jq_tab_show_event").click(function(){
        hide_n_show(3);
    });

    //4
    $("#jq_tab_show_contents").click(function(){
        hide_n_show(4);
    });

    //5
    $("#jq_tab_show_members").click(function(){
        hide_n_show(5);
    });

    //6
    $("#jq_tab_show_admins").click(function(){
        hide_n_show(6);
    });

    //7
    $("#jq_tab_show_about").click(function(){
        hide_n_show(7);
    });



//===========================FROM IBRAHIM=====================================
  function LoadRecentPosts(){


      $("#recent-post-load-div").attr("opacity","0.4");
      $("#recent-post-load-div").attr("disabled","disabled");

      //var postIds = GetJsonString(allRecentPosts);
      //",
      var username = $("#loggedUsername").val();

      $.ajax({
         url : site_url()+"/home/PrintRecentPosts",
         type : "POST",
         data : ({
                    username : username
                    //postIds : postIds
               }),
         success : function(data){
            //alert(eval(data));
            //allRecentPosts

                $("#recent-post-load-div").attr("disabled","");
                $("#recent-post-load-div").attr("opacity","1");
                $("#recent-post-load-div").html(data);
                $("#recent-post-load-div").slideDown('slow');

                



            //UpdateRecentPostList(data);
         }
      })
      //$("#recent-post-load-div").load(,{username:""});
   }

 $("#recent-post-load-div .posts")
     .live("mouseover",function(){
            $(this).css("background-color","#F2F2F2");
   }).live("mouseout",function(){
         $(this).css("background-color","");
   }).live("click",function(){

   });

   $(".show-post-reply").live("click",function(){
       var postId = $(this).attr("postId");
       if($(this).html()=="Reply"){
        $("#post-reply-wrapper-"+postId).slideDown();
        $(this).html("Hide replies");
       }else{
        $("#post-reply-wrapper-"+postId).slideUp();
        $(this).html("Reply");
       }

   });


    $(".replySubmitButtonDiv").live("click",function(){

       var div = $(this).parent().find(".post-reply-input");
       var desc = $(div).val();
       var postId = $(div).attr("postId");
       var cId = $(div).attr("cId");
       SaveReply(desc,cId,postId);
   });

   function SaveReply(description,cId,postId)  //postId parentId
   {
        url = site_url()+ "/make_post/";
        var username = $("#loggedUsername").val();
        $.ajax({
         url: url,
         type: "POST",
         data: ({
                  description : description,
                  cId: cId,
                  publisherName : username,
                  type : 'reply',
                  postId : postId
               }),
         success: function(msg){
            window.location = site_url() + "/community/index/" + cId;
            //LoadRecentPosts();
         }
      })
   }


    
    
    //=====================FULL Calendar======================================

//    var date = new Date();
//    var d = date.getDate();
//    var m = date.getMonth();
//    var y = date.getFullYear();
//
//    $('#calendar').fullCalendar({
//        editable: true,
//        events: [
//        {
//            title: 'All Day Event',
//            start: new Date(y, m, 1)
//        },
//        {
//            title: 'Long Event',
//            start: new Date(y, m, d-5),
//            end: new Date(y, m, d-2)
//        },
//        {
//            id: 999,
//            title: 'Repeating Event',
//            start: new Date(y, m, d-3, 16, 0),
//            allDay: false
//        },
//        {
//            id: 999,
//            title: 'Repeating Event',
//            start: new Date(y, m, d+4, 16, 0),
//            allDay: false
//        },
//        {
//            title: 'Meeting',
//            start: new Date(y, m, d, 10, 30),
//            allDay: false
//        },
//        {
//            title: 'Lunch',
//            start: new Date(y, m, d, 12, 0),
//            end: new Date(y, m, d, 14, 0),
//            allDay: false
//        },
//        {
//            title: 'Birthday Party',
//            start: new Date(y, m, d+1, 19, 0),
//            end: new Date(y, m, d+1, 22, 30),
//            allDay: false
//        },
//        {
//            title: 'Click for Google',
//            start: new Date(y, m, 28),
//            end: new Date(y, m, 29),
//            url: 'http://google.com/'
//        }
//        ]
//    });
    
});