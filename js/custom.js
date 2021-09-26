// Initialize global variables
var scores = [0, 0, 0, 0, 0, 0, 0, 0];  // Stores scores:
                                        // [0:row1, 1:row2, 2:row3, 3:col1, 4:col2, 5:col3, 6:diag1, 7:diag2]
var moves = 0;                          // Counts number of moves
var delay_duration = 500;               // In milliseconds
var turn_lock = 1;                      // Lock must be held before being able to make a move

// Places X or O based on the empty square selected by player
function player_move(id, m) {
    // If player holds turn_lock, proceed with making move
    if (turn_lock == 1) {
        var n = parseInt(id.charAt(id.length - 1));
        var selector = "#p".concat(n);

        // If square is empty...
        if ($(selector).is(":empty")) {
            // ...make move
            $(selector).html(m);
            moves += 1;
            update_scores("player", n);
            var winner = check_winner();

            if (winner) {
                setTimeout(function(){display_winner(winner);}, delay_duration);                
            }
            else {
                if (m == "X")
                    computer_move("O");
                else
                    computer_move("X");
            }
        }
    }
}

// Computer places X or O (m) randomly on an empty square
function computer_move(m) {
    turn_lock = 0; // Grab turn_lock
    var move_made = false;
    var maximum_tries = 100;
    var n; // The position of the move to be made
    var selector; // CSS selector of the position

    // Randomly make a move on an empty square
    for (var i = 1; i <= maximum_tries; i++) {
        n = rand_int(1, 9);
        selector = "#p".concat(n);

        // If square is empty...
        if ($(selector).is(":empty")) {
            // ...make move after brief delay
            setTimeout(function(){$(selector).html(m);}, delay_duration);
            move_made = true;
            break;
        }
    }

    // If move not made after max tries, move to next available square
    if (!move_made) {
        n = get_available_square(1, 9);

        if (n != -1) {
            selector = "#p".concat(n);
            setTimeout(function(){$(selector).html(m);}, delay_duration);
            move_made = true;
        }
    }

    if (move_made) {
        moves += 1;
        update_scores("computer", n);    
        var winner = check_winner();

        if (winner) {            
            setTimeout(function(){display_winner(winner);}, delay_duration);  
        }
        else {
            // Wait for computer to finish making move before releasing turn_lock
            setTimeout(function(){turn_lock = 1;}, delay_duration);            
        }
    }
}

// Returns the first empty square found on the board
// Function called rarely, when computer doesn't move after max tries
function get_available_square(min, max) {
    for (var n = min; n <= max; n++) {
        var selector = "#p".concat(n);

        if ($(selector).is(":empty")) {
            return n;
        }
    }

    return -1;
}

// Update the scores array
function update_scores(who, pos) {
    var point = (who == "computer") ? -1:1;

    switch(pos) {
        case 1:
            scores[0] += point;
            scores[3] += point;
            scores[6] += point;
            break;
        case 2:
            scores[0] += point;
            scores[4] += point;
            break;
        case 3:
            scores[0] += point;
            scores[5] += point;
            scores[7] += point;
            break;
        case 4:
            scores[1] += point;
            scores[3] += point;
            break;
        case 5:
            scores[1] += point;
            scores[4] += point;
            scores[6] += point;
            scores[7] += point;
            break;
        case 6:
            scores[1] += point;
            scores[5] += point;
            break;
        case 7:
            scores[2] += point;
            scores[3] += point;
            scores[7] += point;
            break;
        case 8:
            scores[2] += point;
            scores[4] += point;
            break;
        case 9:
            scores[2] += point;
            scores[5] += point;
            scores[6] += point;
    }
}

// Ruturns whether or not there is a winner
function check_winner() {
    for (var i = 0; i < scores.length; i++) {
        if (scores[i] == 3) {
            return 1; // Player won
        }
        else if (scores[i] == -3) {
            return 2; // Computer won
        }
    }

    if (moves == 9) {
        return 3; // Draw
    }

    return 0; // No winner yet
}

// Displays winner and updates win/loss/draw totals
function display_winner(win_code) {
    switch(win_code) {
        case 1:
            $("#playerWinnerModal").modal("show");
            $.post("play.php", {player_wins: 1});
            $("#wins").html(parseInt($("#wins").text()) + 1);
            break;
        case 2:
            $("#computerWinnerModal").modal("show");
            $.post("play.php", {player_losses: 1});
            $("#losses").html(parseInt($("#losses").text()) + 1);
            break;
        case 3:
            $("#noWinnerModal").modal("show");
            $.post("play.php", {player_draws: 1});
            $("#draws").html(parseInt($("#draws").text()) + 1);
            break;
    }
}

// Generate random int between min and max
function rand_int(min, max) {
    return Math.floor(Math.random() * max) + min;
}