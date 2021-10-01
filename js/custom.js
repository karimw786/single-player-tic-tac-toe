// Initialize global variables
var scores = [0, 0, 0, 0, 0, 0, 0, 0];  // Stores scores:
                                        // [0:row1, 1:row2, 2:row3, 3:col1, 4:col2, 5:col3, 6:diag1, 7:diag2]
var moves = 0;                          // Counts number of moves
var delay_duration = 500;               // In milliseconds
var turn_lock = 1;                      // Lock must be held before being able to make a move
var grid_size = 3;                      // Default board will be 3x3, unless overridden

// Places X or O based on the empty square selected by player
function player_move(id, m) {
    // If player holds turn_lock, proceed with making move
    if (turn_lock == 1) {
        var r = id.substring(1, id.indexOf("c"));   // Row of the move to be made
        var c = id.substring(id.indexOf("c") + 1);  // Col of the move to be made
        var selector = "#r".concat(r, "c", c);      // CSS selector of the position 
        var winner;                                 // Determines winner, if there is one yet

        // If square is empty...
        if ($(selector).is(":empty")) {
            // ...make move
            $(selector).html(m);
            moves += 1;
            update_scores("player", r, c);
            winner = check_winner();

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
    turn_lock = 0;              // Grab turn_lock
    var maximum_tries = 500;    // Randomly make maximum_tries to make a move
    var r;                      // Row of the move to be made
    var c;                      // Col of the move to be made
    var selector;               // CSS selector of the position
    var winner;                 // Determines winner, if there is one yet

    // Randomly make a move on an empty square
    for (var i = 1; i <= maximum_tries; i++) {
        r = rand_int(1, grid_size);
        c = rand_int(1, grid_size);
        selector = "#r".concat(r, "c", c);

        // If square is empty...
        if ($(selector).is(":empty")) {
            // ...make move after brief delay
            setTimeout(function(){$(selector).html(m);}, delay_duration);
            break;
        }
    }

    moves += 1;
    update_scores("computer", r, c);    
    winner = check_winner();

    if (winner) {            
        setTimeout(function(){display_winner(winner);}, delay_duration);  
    }
    else {
        // Wait for computer to finish making move before releasing turn_lock
        setTimeout(function(){turn_lock = 1;}, delay_duration);            
    }
}

// Update the scores array
function update_scores(who, r, c) {
    var point = (who == "computer") ? -1:1;

    scores[r - 1] += point;
    scores[grid_size + (c - 1)] += point;
    if (r == c) scores[2 * grid_size] += point;
    if (grid_size - 1 - (c - 1) == (r - 1)) scores[2 * grid_size + 1] += point;
}

// Ruturns whether or not there is a winner
function check_winner() {
    for (var i = 0; i < scores.length; i++) {
        if (scores[i] == grid_size) {
            return 1; // Player won
        }
        else if (scores[i] == -(grid_size)) {
            return 2; // Computer won
        }
    }

    if (moves == (grid_size * grid_size)) {
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