<?php
require('dataBase.php');
$Gid=$_GET['Gid'];
$SQL="DELETE FROM board_game WHERE Gid='$Gid'";
mysqli_query($link, $SQL);
header('Location: GameUpdate.php');
?>