<?php
session_start();
// Проверяем, пусты ли переменные логина и id пользователя
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    // Если пусты, то мы не выводим ссылку
    echo '<li><a href="reg.php"><span>Регистрация</span></a></li>
          <li><a href="login.php"><span>Вход</span></a></li>';
} else {
    echo '<li><a href="profile.php"><span>Мой профиль</span></a></li>';
}
?>
<?php

// Проверяем, пусты ли переменные логина и id пользователя
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    echo '<form action="save_user.php" method="post">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<br><center>
<p>
    Ваш логин:<br>
    <br><input name="login" type="text" size="15" maxlength="15">
    </p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<p>
    <br><label>Ваш пароль:<br></label>
    <br><input name="password" type="password" size="15" maxlength="15">
    </p>
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p>
    <br><input type="submit" name="submit" value="Зарегистрироваться">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
</p></form>
    </body>
    </html>';
} else {

    // Если не пусты, то мы выводим ссылку
    echo "<br><center>Вы вошли на сайт, как " . $_SESSION['login'] . "<br>";
}
?>
