$(".cityname").click(function(){
    var cityid = $(this).attr("data-cityid");
    var details ={
      "cityid": cityid
    };
  
    $.ajax({
      type:'POST',
      url:'citytable.php',
      data:details,
      success:function(datas){
         window.location.href="schooltable.php";
          
      }
     
  });
  });
  $('#myinput').focusin(function(){
    $(".searchpng").hide();
})