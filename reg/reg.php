<?php
session_start();
// ���������, ����� �� ���������� ������ � id ������������
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    // ���� �����, �� �� �� ������� ������
    echo '<li><a href="reg.php"><span>�����������</span></a></li>
          <li><a href="login.php"><span>����</span></a></li>';
} else {
    echo '<li><a href="profile.php"><span>��� �������</span></a></li>';
}
?>
<?php

// ���������, ����� �� ���������� ������ � id ������������
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    echo '<form action="save_user.php" method="post">
    <!--**** save_user.php - ��� ����� �����������.  �� ����, ����� ������� �� ������ "������������������", ������ �� �����  ���������� �� ��������� save_user.php ������� "post" ***** -->
<br><center>
<p>
    ��� �����:<br>
    <br><input name="login" type="text" size="15" maxlength="15">
    </p>
<!--**** � ��������� ���� (name="login" type="text") ������������ ������ ���� ����� ***** -->
<p>
    <br><label>��� ������:<br></label>
    <br><input name="password" type="password" size="15" maxlength="15">
    </p>
<!--**** � ���� ��� ������� (name="password" type="password") ������������ ������ ���� ������ ***** --> 
<p>
    <br><input type="submit" name="submit" value="������������������">
<!--**** �������� (type="submit") ���������� ������ �� ��������� save_user.php ***** --> 
</p></form>
    </body>
    </html>';
} else {

    // ���� �� �����, �� �� ������� ������
    echo "<br><center>�� ����� �� ����, ��� " . $_SESSION['login'] . "<br>";
}
?>
