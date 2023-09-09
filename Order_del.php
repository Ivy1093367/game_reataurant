<?php
require('dataBase.php');
$Cid=$_GET['Cid'];
$SQL="DELETE FROM order_list WHERE Cid='$Cid'";
mysqli_query($link, $SQL);
header('Location: OrderInfo.php');
?>