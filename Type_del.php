<?php
require('dataBase.php');
$TNumber=$_GET['TNumber'];
$SQL="DELETE FROM types WHERE TNumber='$TNumber'";
mysqli_query($link, $SQL);
header('Location: TypeInfo.php');
?>