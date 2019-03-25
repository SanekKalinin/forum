<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
    include('layout.php');
    include('content.php');
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    
<div class="main">
   <div class="header"> <h1><a href="/"> Наилучший форум, создан на PHP и MySQL </a></h1> </div>
    <div class="loginField">
     <?php
                session_start();
            if (isset($_SESSION['username'])){
                welcomeMessage();
                logout();
            }
            else {
                if (isset($_GET['status'])) {
            if ($_GET['status']=='register-success') {
                echo "<h1 style='color:green'>Поздравляем! Вы успешно зарегистрированы!</h1>";
            }
            else if ($_GET['status']=='register-fail') {
                echo "<h1 style='color:red'>Ошибка при регистрации</h1>";
            }
            else if ($_GET['status']=='login-fail') {
                echo "<h1 style='color:red'>Неправильное имя пользователя и/или пароль</h1>";
            }
                }
                loginform();
            }
     ?>
        
    </div>
    
        <div class="forumdesk"> <p> Добро пожаловать в лучший форум</p>
        <div class="categories">
           <h1 style ='color:blue'>Категории</h1>
            <?php
        showTopics($_GET['categ_id'], $_GET['subcat_id']);
             ?>
        </div>
    </div>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<div class="content"> <a href=newtopic.php?categ_id='
            .$_GET['categ_id'].'&subcat_id='.$_GET['subcat_id'].'> Новая тема</a></div>';
        }
        ?>

</div>



</body>
</html>