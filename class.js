$(".allstudents").click(function(){
    var classid = $(this).attr("data-classId");
    var details ={
      "classid": classid
    };
  
    $.ajax({
      type:'POST',
      url:'classtable.php',
      data:details,
      success:function(datas){
         window.location.href="studenttable.php";
          
      }
     
  });
  });
  $('#myinput').focusin(function(){
    $(".searchpng").hide();
})
