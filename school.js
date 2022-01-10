$(".allclass").click(function(){
    var schoolid = $(this).attr("data-schoolid");
    var details ={
      "schoolid": schoolid
    };
  
    $.ajax({
      type:'POST',
      url:'schooltable.php',
      data:details,
      success:function(datas){
         window.location.href="classtable.php";
          
      }
     
  });
  });
  $(".allstudent").click(function(){
    var schoolid = $(this).attr("data-schoolid");
    var details ={
      "schoolid": schoolid
    };
  
    $.ajax({
      type:'POST',
      url:'schooltable.php',
      data:details,
      success:function(datas){
         window.location.href="studenttable.php";
          
      }
     
  });
  });
  $('#myinput').focusin(function(){
    $(".searchpng").hide();
})
