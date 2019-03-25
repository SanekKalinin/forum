<?php
session_start();
include('dbconn.php');
$comment=nl2br(addslashes($_POST['comment']));
$categ_id=$_GET['categ_id'];
$subcat_id=$_GET['subcat_id'];
$topic_id=$_GET['topic_id'];
$insert="INSERT INTO replies (`categ_id`,`subcat_id`,`topic_id`,`author`,`comment`,`date_posted`)
VALUES 
(".$categ_id.",".$subcat_id.",".$topic_id.",'".$_SESSION['username']."','".$comment."',now());";
$result=mysqli_query($connection,$insert) or die("Ошибка " . mysqli_error($connection));
if ($result) {
    header("location: readtopic.php?categ_id=".$categ_id."&subcat_id=".$subcat_id."&topic_id=".$topic_id."");
}
?>