<?php
session_start();
$photo = $_SESSION['photo'];
header('Content-Type: image/jpeg');
echo($photo);
?>