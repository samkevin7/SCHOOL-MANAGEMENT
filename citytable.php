<?php 
session_start();
include_once 'conn.php';
// $sql="SELECT * FROM `city`";
// $res = $conn->query($sql);
$count="SELECT COUNT(`si_no`)as count FROM city";
$coun = $conn->query($count);
$results_per_page=7;
$sql="SELECT * FROM `city`";
$result=$conn->query($sql);
 $numofresult=mysqli_num_rows($result);
  $numofpages=ceil($numofresult / $results_per_page);
 if(!isset($_GET['page'])){
                  $page=1;
         }else{
                    $page=$_GET['page'];
                }
                $cityid=$_POST["cityid"];
                $_SESSION["cityid"]=$cityid;
$pageresult=($page-1)* $results_per_page;
                
$sql1="SELECT * FROM `city` LIMIT " .$pageresult.",".$results_per_page;
$result1=$conn->query($sql1);
                // echo $sql1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CITY TABLE</title>
    <link rel="stylesheet" href="school.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    var $block = $('.error');
  $("#myinput").keyup(function() {
    var isMatch = false;
    var value = $(this).val();
    $(".mytable tr").each(function() {
        var content = $(this).html();
      if(content.toLowerCase().indexOf(value) == -1){
         $(this).hide(); 
      }else{
          isMatch=true;
          $(this).show();
      }
    });
    $block.toggle(!isMatch);
  });
});
</script>
</head>
<body style=" background-color:#f3f7fa;">
 <div class="logo">
    <img class="log" src="./School Management/Fresh Schools Management/Logo.png" alt="">
</div>
<div class="vertical">
   <div><p class="school">SCHOOL MANAGEMENT</p></div>
   <div><p class="sidetext" id="city" style="border-left: 5px solid rgb(45, 45, 196);
        background-color:#eef0f3 ; color: rgb(45, 45, 196);" ><img class="listpng" src="./School Management/Fresh Schools Management/City List.png" alt=""><a class="li" style="color: rgb(45, 45, 196);" href="">City List</a> </p></div>
   <div><p class="sidetext" id="class"><img class="listpng" src="./School Management/Fresh Schools Management/Class List.png" alt=""><a class="li" href="classtable.php">Class List</a></p></div>
   <div><p class="sidetext" id="school"><img class="listpng" src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a class="li" href="schooltable.php">School List</a></p></div>
   <div><p class="sidetext" id="student" ><img class="listpng" src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="li" href="studenttable.php">Student List</a></p></div>
</div> 
<div class="main">
    <div class="nav">
        <p class="list" style="color: #505050;">City List</p>
        <p class="total">Total Cities - <?php while($rw=$coun->fetch_assoc()){echo $rw['count']; }?></p>
        <input type="text" placeholder="Search" id="myinput">
        <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
        
    </div>
    <table id="customers">
        <tr>
          <th>SI.NO</th>
          <th>City Id</th>
          <th>City Name</th>
          <th>State</th>
        </tr>
        <?php
    while($row=$result1->fetch_assoc())
    {
        ?>
        <tbody class=mytable>
                <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['city_id'];?></td>
                <td class="cityname"  id="link" data-cityid="<?php echo $row['city_id'];?>"><?php echo $row['city_name'];?></td>
                <td><?php echo $row['state'];?></td>
                </tr>
        </tbody>
                <?php
                }
                
                ?>
                <div class="error" style="display: none;">No records found</div>
      </table>
      <div class="pagination">
      <?php
                
                for($page=1;$page<=$numofpages;$page++){
                    ?>
                    <a href="<?php echo 'citytable.php?page='.$page;?>">
                    <?php 
                    echo $page;
                    ?>
                    </a>
                    <?php
                }
                ?>
                </div>

</div>
<script src="city.js"></script>
</body>
</html>