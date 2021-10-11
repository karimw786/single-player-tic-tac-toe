<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Single-Player Tic-Tac-Toe</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <?php 
        if (isset($_SESSION["grid_size"]) and ($_SESSION["grid_size"] == "4")) {
            echo '<link href="css/custom-overrides.css" rel="stylesheet">';
        }
    ?>
</head>
<body>
    <div class="container">