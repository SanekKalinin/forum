<?php
session_start();
include ('dbconn.php');
$topic=addslashes($_POST['topic']);
$content=nl2br(addcslashes($_POST['content']));
$categ_id=$_GET['categ_id'];
$subcat_id=$_GET['subcat_id'];
$query="INSERT INTO topics (`categ_id`,`subcat_id`,`author`,`title`,`content`,`date_posted`)
        VALUES ('".$categ_id."','".$subcat_id."','".$_SESSION['username']."','".$topic."','".$content."',now());";
$insert=mysqli_query($connection,$query) or die("Ошибка " . mysqli_error($connection));
echo $insert;
if ($insert) {

    header("location: topics.php?categ_id=".$categ_id."&subcat_id=".$subcat_id."");
}


?>