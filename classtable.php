<?php 
session_start();
include_once 'conn.php';

// $sql3="SELECT * FROM `class`";
// $res = $conn->query($sql3);
$count="SELECT COUNT(`si_no`)as count FROM class";
$coun = $conn->query($count);
$results_per_page=7;
$sql="SELECT * FROM `class`";
$result=$conn->query($sql);
 $numofresult=mysqli_num_rows($result);
  $numofpages=ceil($numofresult / $results_per_page);
 if(!isset($_GET['page'])){
                  $page=1;
         }else{
                    $page=$_GET['page'];
                }
                $classid=$_POST["classid"];
                $_SESSION["classid"]=$classid;
                $_SESSION["ageid"]=$_POST["ageid"];
$pageresult=($page-1)* $results_per_page;
                
// $sql1="SELECT * FROM `class` LIMIT " .$pageresult.",".$results_per_page;
// $result1=$conn->query($sql1);
                // echo $sql1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLASS TABLE</title>
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
   <div><p class="sidetext" id="class" style ="border-left: 5px solid #444444;
        background-color:#eef0f3 ; color: #444444;"><img class="listpng" src="./School Management/Fresh Schools Management/Class List.png" alt=""><a class="li" style="color: #444444;">Class List</a></p></div>
   <div><p class="sidetext" id="school"><img class="listpng" src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a class="li" href="schooltable.php">School List</a></p></div>
   <div><p class="sidetext" id="student"><img class="listpng" src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="li" href="studenttable.php">Student List</a></p></div>
</div> 
<div class="main">
    <div class="nav">
        <p class="list" style="color: #505050;">Class List</p>
        <p class="total">Total Classes - <?php while($rw=$coun->fetch_assoc()){echo $rw['count']; }?></p>
        <input type="text" placeholder="Search" id="myinput">
        <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
    </div>
    <table id="customers">
        <tr>
          <th>SI.NO</th>
          <th>Class Id</th>
          <th>Standard</th>
          <th>Section</th>
          <th>School id</th>
          <th>Action</th>
        </tr>
        <?php
        $schoolid=$_SESSION["schoolid"];
            if($schoolid){
                $sql1="SELECT class.si_no,class.class_id,class.standard,class.section,class.school_id FROM `school` INNER JOIN class on school.school_id=class.school_id where class.school_id=$schoolid ";
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
            <tbody class="mytable">
            <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['class_id'];?></td>
                <td><?php echo $row['standard'];?></td>
                <td><?php echo $row['section'];?></td>
                <td><?php echo $row['school_id'];?></td>
                <td class="allstudents" data-classId="<?php echo $row['class_id'];?>"><?php echo "All students";?></td>
                </tr>
            </tbody>
                <?php   
                }
            }else{
                $sql1='SELECT * FROM class LIMIT ' .$pageresult.','.$results_per_page;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
                <tbody class="mytable">
                <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['class_id'];?></td>
                <td><?php echo $row['standard'];?></td>
                <td><?php echo $row['section'];?></td>
                <td><?php echo $row['school_id'];?></td>
                <td class="allstudents" id="link1" data-classId="<?php echo $row['class_id'];?>"><?php echo "All students";?></td>
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
                    <a href="<?php echo 'classtable.php?page='.$page;?>">
                    <?php 
                    echo $page;
                    ?>
                    </a>
                    <?php
                }
                ?>
                </div>

</div>
<script src="student.js"></script>
<script src="class.js"></script>
</body>
</html>
