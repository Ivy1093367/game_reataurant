<?php
require('dataBase.php');
$Mid=$_GET['Mid'];
$SQL="DELETE FROM menu WHERE Mid='$Mid'";
mysqli_query($link, $SQL);
header('Location: MenuInfo.php');
?>