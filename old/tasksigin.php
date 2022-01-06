<?php
$email =$_POST["email"];
$password=$_POST["password"];
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo("$email is not valid email address<br>");
          $conn->close();
}
include_once 'config.php';
 $sql ="SELECT * FROM `taskuser` WHERE `email`='$email' and `password`='$password'";
 $sql1 ="SELECT * FROM `taskuser` WHERE `email`!='$email' and `password`='$password'";
 $sql2 ="SELECT * FROM `taskuser` WHERE `email`='$email' and `password`!='$password'";
$getrows=$conn->query($sql);
$getrows1=$conn->query($sql1);
$getrows2=$conn->query($sql2);
 if ($getrows->num_rows>0) {
     echo  "login succesful <br>";   
   }
  elseif($getrows1->num_rows>0 && $conn->query($sql1)){
    echo  "wrong email <br>";   
}
 elseif($getrows2->num_rows>0 && $conn->query($sql2)){
         echo  "wrong password <br>";   
 }
else {
   echo "wrong credentials";
 }
 $conn->close();
 ?>


