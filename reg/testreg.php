<head>

<link type="text/css" media="screen" rel="stylesheet" href="../stylesheets/main.css" />

<?php
    session_start();//  ��� ��������� �������� �� �������. ������ � ��� �������� ������  ������������, ���� �� ��������� �� �����. ����� ����� ��������� �� �  ����� ������ ���������!!!
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������
if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    exit ("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
    }
    //���� ����� � ������ �������,�� ������������ ��, ����� ���� � ������� �� ��������, ���� �� ��� ���� ����� ������
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
$password = stripslashes($password);
    $password = htmlspecialchars($password);
//������� ������ �������
    $login = trim($login);
    $password = trim($password);
// ������������ � ����
    include ("bd.php");// ���� bd.php ������ ���� � ��� �� �����, ��� � ��� ���������, ���� ��� �� ���, �� ������ �������� ���� 
 
$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); //��������� �� ���� ��� ������ � ������������ � ��������� �������
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['password']))
    {
    //���� ������������ � ��������� ������� �� ����������
    exit ("��������, �������� ���� ����� ��� ������ ��������.");
    }
    else {
    //���� ����������, �� ������� ������
    if ($myrow['password']==$password) {
    //���� ������ ���������, �� ��������� ������������ ������! ������ ��� ����������, �� �����!
    $_SESSION['login']=$myrow['login']; 
    $_SESSION['id']=$myrow['id'];//��� ������ ����� ����� ������������, ��� �� � ����� "������ � �����" �������� ������������
    echo '<META http-equiv="refresh" content="0; url=../main.php">';
    }
 else {
    //���� ������ �� �������

    exit ("��������, �������� ���� login ��� ������ ��������.");
    }
    }
?>

