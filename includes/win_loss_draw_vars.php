<?php
if (!isset($_SESSION["player_wins"])) {
    $_SESSION["player_wins"] = 0;
}
if (!isset($_SESSION["player_losses"])) {
    $_SESSION["player_losses"] = 0;
}
if (!isset($_SESSION["player_draws"])) {
    $_SESSION["player_draws"] = 0;
}

if (isset($_POST["player_wins"])) {
    $_SESSION["player_wins"] += $_POST["player_wins"];
}
if (isset($_POST["player_losses"])) {
    $_SESSION["player_losses"] += $_POST["player_losses"];
}
if (isset($_POST["player_draws"])) {
    $_SESSION["player_draws"] += $_POST["player_draws"];
}
?>