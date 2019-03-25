<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
    include('layout.php');
    include('content.php');
    refreshView($_GET['categ_id'],$_GET['subcat_id'],$_GET['topic_id']);
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
        <div class="categories">
           <h1 style ='color:blue'>Категории</h1>
            <?php
        showTopic($_GET['categ_id'], $_GET['subcat_id'],$_GET['topic_id']);
             ?>
        </div>
    </div>
    
        <div class="forumdesk"> <p> Добро пожаловать в лучший форум</p>
          <?php
          if (!isset($_SESSION['username'])) {
              echo '<p> Пожалуйста авторизуйтесь или <a href=register.html> зарегистрируйтесь здесь</a> </p>';
            }                
        ?>
        </div>
        <?php
          if (isset($_SESSION['username'])) {
              reply($_GET['categ_id'], $_GET['subcat_id'],$_GET['topic_id']);
          }
          ?>
        <div class='content'>
        <?php
        showTopic($_GET['categ_id'],$_GET['subcat_id'],$_GET['topic_id']);
           ?>     
        </div>
</div>
</body>
</html>