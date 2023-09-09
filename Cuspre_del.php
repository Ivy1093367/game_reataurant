<?php
require('dataBase.php');
$Cid=$_GET['Cid'];
$SQL="DELETE FROM choose_type WHERE Cid='$Cid'";
mysqli_query($link, $SQL);
header('Location: CuspreferInfo.php');
?>