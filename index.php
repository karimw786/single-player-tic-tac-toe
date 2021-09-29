<?php 
session_start();

// App entry point
// If user is already registered, take user to the game board
// Otherwise, allow user to register
if (isset($_SESSION["player_name"]) and isset($_SESSION["player_move"]))
    header("location: play.php");
else
    header("location: register.php");
?>