<?php
if (empty($_POST["name"])) {
  die ("name required");
}
else{
$name =$_POST["name"];
}
if (empty($_POST["email"])) {
    die ("email is required");   
}
else{
$email=$_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("$email is not valid email address<br>");
  }
}
if (empty($_POST["password"])) {
    die ("password is required");   
}
else{
$password=$_POST["password"];
}
if (empty($_POST["city"])) {
    die ("city is required");
}
else{
$city =$_POST["city"];
}
include_once 'config.php';
$sql1 = "SELECT * FROM `taskuser` WHERE `email` = '$email'";
$sql ="INSERT INTO `taskuser`(`name`, `email`, `password`, `city`) VALUES ('$name','$email','$password','$city')";
$getrows1=$conn->query($sql1);
if ($getrows1->num_rows>0)
{
     echo  "user  already exist kindly login <br>";   
   }

elseif($conn->query($sql)){
echo "user $name inserted";
}
  else{
   echo "not inserted";
 }
 $conn->close();
 ?>
