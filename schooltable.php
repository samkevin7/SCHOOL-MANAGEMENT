<?php 
session_start();
include_once 'conn.php';
// $sql="SELECT * FROM `school`";
// $res = $conn->query($sql);
$count="SELECT COUNT(`si_no`)as count FROM school";
$coun = $conn->query($count);
$results_per_page=7;
$sql="SELECT * FROM `school`";
$result=$conn->query($sql);
 $numofresult=mysqli_num_rows($result);
  $numofpages=ceil($numofresult / $results_per_page);
 if(!isset($_GET['page'])){
                  $page=1;
         }else{
                    $page=$_GET['page'];
                }
$pageresult=($page-1)* $results_per_page;
            $_SESSION["schoolid"] =$_POST["schoolid"];   
// $sql1="SELECT * FROM `school` LIMIT " .$pageresult.",".$results_per_page;
// $result1=$conn->query($sql1);
                // echo $sql1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHOOL TABLE</title>
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
   <div><p class="sidetext" id="city" ><img class="listpng" src="./School Management/Fresh Schools Management/City List.png" alt=""><a class="li" href="citytable.php">City List</a></p></div>
   <div><p class="sidetext" id="class"><img class="listpng" src="./School Management/Fresh Schools Management/Class List.png" alt=""> <a class="li" href="classtable.php">Class List</a></p></div>
   <div><p class="sidetext" id="school" style = "border-left: 5px solid #3dbce8;
        background-color:#eef0f3 ;color :#3dbce8;"><img class="listpng" src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a class="li" style="color :#3dbce8;"> School List</a></p></div>
   <div><p class="sidetext" id="student"><img class="listpng" src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="li" href="studenttable.php">Student List</a></p></div>
</div> 
<div class="main">
    <div class="nav">
        <p class="list" style="color: #505050;">School List</p>
        <p class="total">Total Schools - <?php while($rw=$coun->fetch_assoc()){echo $rw['count']; }?></p>
        <input type="text" placeholder="Search" id="myinput">
        <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
    </div>
    <table id="customers">
        <tr>
          <th>SI.NO</th>
          <th>School Id</th>
          <th>School Name</th>
          <th>City id</th>
          <th>City name</th>
          <th>State</th>
          <th>Country</th>
          <th>Action</th>
          <th></th>
        </tr>
        <?php
        $cityid=$_SESSION["cityid"];
        if($cityid){
          $sql1="SELECT school.si_no,school.school_id,school.school_name,school.city_id,school.city_name,school.state,school.country FROM `city` INNER JOIN school on city.city_id=school.city_id where school.city_id =$cityid ";
          $result2=$conn->query($sql1);
      while ($row = $result2->fetch_assoc()) {
          ?>
      <tbody class="mytable">
      <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['school_id'];?></td>
                <td><?php echo $row['school_name'];?></td>
                <td><?php echo $row['city_id'];?></td>
                <td><?php echo $row['city_name'];?></td>
                <td><?php echo $row['state'];?></td>
                <td><?php echo $row['country'];?></td>
                <td class="allclass" id="link2" data-schoolid="<?php echo $row['school_id'];?>">all class</td>
                <td class="allstudent" id="link3" data-schoolid="<?php echo $row['school_id'];?>">all students</td>
                </tr>
                <?php   
                }
            }else{
                $sql1='SELECT * FROM `school` LIMIT ' .$pageresult.','.$results_per_page;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
                <tbody class="mytable">
                <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['school_id'];?></td>
                <td><?php echo $row['school_name'];?></td>
                <td><?php echo $row['city_id'];?></td>
                <td><?php echo $row['city_name'];?></td>
                <td><?php echo $row['state'];?></td>
                <td><?php echo $row['country'];?></td>
                <td class="allclass" data-schoolid="<?php echo $row['school_id'];?>">all class</td>
                <td class="allstudent" data-schoolid="<?php echo $row['school_id'];?>">all students</td>
                </tr>
        </tbody>
                <?php
                }
            }
                ?>
        <div class="error" style="display: none;">No records found</div>
      </table>
      <div class="pagination">
      <?php
                
                for($page=1;$page<=$numofpages;$page++){
                    ?>
                    <a href="<?php echo 'schooltable.php?page='.$page;?>">
                    <?php 
                    echo $page;
                    ?>
                    </a>
                    <?php
                }
                ?>
                </div>

</div>
<script src="school.js"></script>
</body>
</html>