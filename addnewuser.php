<?php
include ('dbconn.php');
$newUser=$_POST['usernameinput'];
$newPass=$_POST['passwordinput'];
$newFName=$_POST['firstnameinput'];
$newLName=$_POST['lastnameinput'];
$salt=random_int(0, PHP_INT_MAX);
$hashPass=md5($newUser.$newPass.$salt);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
 $insert="INSERT INTO users (userName,firstName,lastName,salt,passHash) VALUES ('$newUser','$newFName','$newLName','$salt','$hashPass')";
 

 if (mysqli_query($connection,$insert)) {
    header("location: /index.php?status=register-success");
}
else {
    
              
    header("location: /showTopics($_GET['categ_id'], $_GET['subcat_id']);"); 
}
?>