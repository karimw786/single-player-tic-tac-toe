<?php
session_start();

// If user has registered, take them to the game board
if (isset($_POST["player_name"]) and isset($_POST["player_move"]) and isset($_POST["grid_size"])) {
    $_SESSION["player_name"] = $_POST["player_name"];
    $_SESSION["player_move"] = $_POST["player_move"];
    $_SESSION["grid_size"] = $_POST["grid_size"];

    if ($_SESSION["player_move"] == "X")
        $_SESSION["computer_move"] = "O";
    else
        $_SESSION["computer_move"] = "X";

    header("location: play.php");
}

require_once("includes/header.php");
?>

    <div class="row">
        <div class="col">
            <h1 class="text-center">Player Registration</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form action="register.php" method="post">
                <div class="form-group">
                    <label>Player name</label>
                    <input class="form-control" type="text" name="player_name" maxlength="30" required />
                </div>
                <div class="form-group">
                    <label>Would you like to move first or second?</label>
                    <select class="form-select" name="player_move" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="X">Move first (play as X)</option>
                        <option value="O">Move second (play as O)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Choose board size</label>
                    <select class="form-select" name="grid_size" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="3">3x3 board (requires three X's/O's to win)</option>
                        <option value="4">4x4 board (requires four X's/O's to win)</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <input class="btn btn-primary btn-lg" type="submit" value="Play Tic-Tac-Toe!" />
                </div>
            </form>
        </div>        
    </div>    
        
<?php require_once("includes/footer.php"); ?>