<?php
require('dataBase.php');
$Cid=$_GET['Cid'];
$SQL="DELETE FROM customer WHERE Cid='$Cid'";
mysqli_query($link, $SQL);
header('Location: CusInfo.php');
?>