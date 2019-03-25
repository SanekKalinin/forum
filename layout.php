<?php
function loginform() {
echo "<form action='validation.php' method='POST'>
<p>Имя пользователя :</p>
<input type='text' id='usernameinput' name='usernameinput'/>
<p>Пароль :</p>
<input type='password' id='passwordinput' name='passwordinput'/>
<input type='submit' value='Войти'/>
<button type='button' onclick='location.href=\"register.html\";'> Зарегистрироваться</button>
</form> ";
}

function welcomeMessage() {
echo "<p>Добро пожаловать ".$_SESSION['lastName']." ".$_SESSION['firstName']."!"."</p>";
}

function logout() {
    echo "<form action='logout.php' method='GET'> 
    <input type='submit' value='Выйти'/></form>";
}


?>
