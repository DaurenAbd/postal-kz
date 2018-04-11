<?php
header('Content-Type: text/html; charset=cp1251');
$page=$_POST['page'];
$page=trim(htmlspecialchars($page));
include_once("pages/".$page.".php");
?>