<?php
session_start();
include('dbconn.php');
$userName=$_POST['usernameinput'];
$password=$_POST['passwordinput'];
$query="SELECT salt,passHash,firstName,lastName FROM users WHERE userName='$userName'";

$result = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection)); 
$userData = mysqli_fetch_array($result); // array[0] = salt; array[1] = hash, [3] firstName, [4] lastName


If (md5($userName.$password.$userData[salt])===$userData[passHash]) {
    $_SESSION['username']=$userName;
    $_SESSION['firstName']=$userData[firstName];
    $_SESSION['lastName']=$userData[lastName];
    header("location:/index.php"); 
} else {
 header ("location:/index.php?status='login-fail'");

} 
?>
