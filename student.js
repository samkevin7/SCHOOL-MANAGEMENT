$('.input').click(function(e){
    e.preventefault;
   var ageid = $(this).val();
   var details={
       "ageid":ageid
   };
   $.ajax({
       type:'POST',
       url:'classtable.php',
       data:details,
       success:function(datas){
        window.location.href='studenttable.php';
       } 
   })
})