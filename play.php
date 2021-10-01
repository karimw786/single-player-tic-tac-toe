<?php
session_start();

// If user is NOT already registered, allow them to register
if (!isset($_SESSION["player_name"]) or !isset($_SESSION["player_move"]) or !isset($_SESSION["grid_size"])) {
    header("location: register.php");
}

// Initialize win/loss/draw session variables, if not already set
if (!isset($_SESSION["player_wins"])) {
    $_SESSION["player_wins"] = 0;
}
if (!isset($_SESSION["player_losses"])) {
    $_SESSION["player_losses"] = 0;
}
if (!isset($_SESSION["player_draws"])) {
    $_SESSION["player_draws"] = 0;
}

// If win/loss/draw post variables are set, increment associated session variables
if (isset($_POST["player_wins"])) {
    $_SESSION["player_wins"] += $_POST["player_wins"];
}
elseif (isset($_POST["player_losses"])) {
    $_SESSION["player_losses"] += $_POST["player_losses"];
}
elseif (isset($_POST["player_draws"])) {
    $_SESSION["player_draws"] += $_POST["player_draws"];
}

require_once("includes/output_helpers.php");
require_once("includes/header.php");
?> 

    <div class="row">
        <div class="col">
            <h1 class="text-center">Tic-Tac-Toe</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="player_moves">
                <?php echo "<strong>" . $_SESSION["player_move"] . "</strong>: " . $_SESSION["player_name"] . " vs. <strong>" . $_SESSION["computer_move"] . "</strong>" . ": Computer"; ?>
            </div>
        </div>
        <div class="col">
            <div id="wins_losses">
                <strong>Wins</strong>: <span id="wins"><?php echo $_SESSION["player_wins"]; ?></span> | 
                <strong>Losses</strong>: <span id="losses"><?php echo $_SESSION["player_losses"]; ?></span> | 
                <strong>Draws</strong>: <span id="draws"><?php echo $_SESSION["player_draws"]; ?></span>
            </div>
        </div>
        <div class="col">
            <div id="menu">
                <a class="btn btn-primary" href="play.php" role="button">Play Again</a> <a class="btn btn-danger" href="logout.php" role="button">Quit</a>
            </div>
        </div>
    </div>

    <?php draw_board($_SESSION["grid_size"], $_SESSION["grid_size"]); ?>
    <?php output_modal("playerWinnerModal", "Congrats, " . $_SESSION['player_name'] . "! You win!"); ?>
    <?php output_modal("computerWinnerModal", "Computer wins. Better luck next time, " . $_SESSION['player_name'] . "!"); ?>
    <?php output_modal("noWinnerModal", "It's a draw!"); ?>

<?php require_once("includes/footer.php"); ?>