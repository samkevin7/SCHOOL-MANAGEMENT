<?php 
session_start();
include_once 'conn.php';
// $sql3="SELECT * FROM `student`";
// $res = $conn->query($sql3);
$count="SELECT COUNT(`si_no`)as count FROM `student`";
$coun = $conn->query($count);
$results_per_page=7;
 $sql='SELECT * FROM student';
$result=$conn->query($sql);
 $numofresult=mysqli_num_rows($result);
  $numofpages=ceil($numofresult / $results_per_page);
 if(!isset($_GET['page'])){
                  $page=1;
         }else{
                    $page=$_GET['page'];
                }
$pageresult=($page-1)* $results_per_page;
                
// $sql1='SELECT * FROM student LIMIT ' .$pageresult.','.$results_per_page;
// $result2=$conn->query($sql1);
//                 // echo $sql1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT TABLE</title>
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
<body style="background-color:#f3f7fa;">
 <div class="logo">
    <img class="log" src="./School Management/Fresh Schools Management/Logo.png" alt="">
</div>
<div class="vertical">
   <div><p class="school">SCHOOL MANAGEMENT</p></div>
   <div><p class="sidetext" id="city" ><img class="listpng" src="./School Management/Fresh Schools Management/City List.png" alt=""><a class="li" href="citytable.php">City List</a></p></div>
   <div><p class="sidetext" id="class"><img class="listpng" src="./School Management/Fresh Schools Management/Class List.png" alt=""><a class="li" href="classtable.php">Class List</a></p></div>
   <div><p class="sidetext" id="school"><img class="listpng" src="./School Management/Fresh Schools Management/School Listt.png" alt=""><a class="li" href="schooltable.php">School List</a></p></div>
   <div><p class="sidetext" id="student" style = " border-left: 5px solid #d642c8;background-color: #eef0f3 ; color: #d642c8;"><img class="listpng" src="./School Management/Fresh Schools Management/Student List.png" alt=""><a class="li" style="color: #d642c8;">Student List</a></p></div>
</div> 
<div class="main">
    <div class="nav">
        <p class="list" style="color: #505050;">Students List</p>
        <p class="total">Total Student - <?php while($rw=$coun->fetch_assoc()){echo $rw['count']; }?></p>
        <input type="text" placeholder="Search" id="myinput">
        <img class="searchpng" src="./School Management/Fresh Schools Management/Search Icon.png" alt="">
       <!-- <p><img src="./School Management/Fresh Schools Management/Filter.png" alt="">Filter</p> -->
       <button class='filter' onclick="myFunc()"><img src="./School Management/Fresh Schools Management/Filter.png" alt="" id="filter"><span class="fil">Filter</span></button>
           <div class="dropdown">
           <div class="myfilter" id="filter-content"><p class='age'>Age</p>
               <input type="radio" class='input' id='1' name='filter'value="'3'and'5'"><label for="1">3 to 5</label>
               <input type="radio" class='input' id='2' name='filter'value="'6'and'9'"><label for="2">6 to 9</label>
               <input type="radio" class='input' id='3' name='filter'value="'10'and'12'"><label for="3">10 to 12</label>
               <input type="radio" class="input" id='4' name='filter'value="'13'and'15'"><label for="4">13 to 15</label>
               <input type="radio" class="input" id='5' name='filter'value="'16'and'18'"><label for="5">16 to 18</label>
               </div>
           </div>
    </div>
    <table id="customers">
        <tr>
          <th>SI.NO</th>
          <th>Student Id</th>
          <th>Student Name</th>
          <th>Gender</th>
          <th id="age">Age</th>
          <th>Father name</th>
          <th>Mobile number</th>
          <th>Class Id</th>

        </tr>
        <?php
        $classid=$_SESSION["classid"];
        $schoolid=$_SESSION["schoolid"];
        $ageid=$_SESSION["ageid"];
            if($classid){
                $sql1="SELECT student.si_no,student.student_id,student.student_name,student.gender,student.age,student.father_name,student.mobile_number,student.class_id FROM `class` INNER JOIN  student ON student.class_id = class.class_id where class.class_id = $classid;";
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
            <tbody class="mytable">
            <tr>
            <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['student_id'];?></td>
                <td><?php echo $row['student_name'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['age'];?></td>
                <td><?php echo $row['father_name'];?></td>
                <td><?php echo $row['mobile_number'];?></td>
                <td><?php echo $row['class_id'];?></td>
            </tr>
            </tbody>
            <?php   
                }
            }elseif($ageid){
                $sql1="SELECT * FROM `student` WHERE age BETWEEN $ageid LIMIT $pageresult , $results_per_page;" ;
                $result2=$conn->query($sql1);
                if($result2->num_rows == 0){
                    ?>
                    <div class="ageerror">Students of this age not found</div>
                 <?php   
                }
            while ($row = $result2->fetch_assoc()) {
                ?>
                <tbody class="mytable">
                <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['student_id'];?></td>
                <td><?php echo $row['student_name'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['age'];?></td>
                <td><?php echo $row['father_name'];?></td>
                <td><?php echo $row['mobile_number'];?></td>
                <td><?php echo $row['class_id'];?></td>
                </tr>
        </tbody>
                <?php
                }
            }elseif($schoolid){
                $sql1="SELECT * FROM ((student INNER JOIN class ON student.class_id=class.class_id)INNER JOIN school ON school.school_id=class.school_id) where school.school_id=$schoolid" ;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
                <tbody class="mytable">
                <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['student_id'];?></td>
                <td><?php echo $row['student_name'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['age'];?></td>
                <td><?php echo $row['father_name'];?></td>
                <td><?php echo $row['mobile_number'];?></td>
                <td><?php echo $row['class_id'];?></td>
                </tr>
        </tbody>
                <?php
                }
            }else{
                $sql1='SELECT * FROM student LIMIT ' .$pageresult.','.$results_per_page;
                $result2=$conn->query($sql1);
            while ($row = $result2->fetch_assoc()) {
                ?>
                <tbody class="mytable">
                <tr>
                <td><?php echo $row['si_no'];?></td>
                <td><?php echo $row['student_id'];?></td>
                <td><?php echo $row['student_name'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['age'];?></td>
                <td><?php echo $row['father_name'];?></td>
                <td><?php echo $row['mobile_number'];?></td>
                <td><?php echo $row['class_id'];?></td>
                </tr>
        </tbody>
                <?php
                }
            }
                ?>
        <div class="error" style="display: none;">No records found</div>
      </table>
      <p class="page">page <span class="border"><?php echo $page;?></span>of <?php echo $numofpages;?></p>
      <div class="pagination">
      <?php
                
                for($page=1;$page<=$numofpages;$page++){
                    ?>
                    <a href="<?php echo 'studenttable.php?page='.$page;?>">
                    <?php 
                    echo $page;
                    ?>
                    </a>
                    <?php
                }
                ?>
                </div>

                </div>
                 <script>
                function myFunc(){
                    document.getElementById("filter-content").classList.toggle("show");
                }
            </script>
      <script src="student.js"></script>
</body>
</html>
