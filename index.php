<?php 
session_start();

if (isset($_SESSION["player_name"]) and isset($_SESSION["player_move"]))
    header("location: play.php");
else
    header("location: register.php");
?>