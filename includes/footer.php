    </div> <!-- end div container -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <?php
        $extra_js = '<script type="text/javascript">';

        // Override grid_size and scores[] in custom.js, if 4x4 board selected
        if (isset($_SESSION["grid_size"]) and ($_SESSION["grid_size"] == "4")) {
            $extra_js .= 'grid_size = 4;';
            $extra_js .= 'scores = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];';
        }

        // If user chooses to move first, wait for their first move 
        if (isset($_SESSION["player_move"])) {
            if ($_SESSION["player_move"] == "X") {
                $extra_js .= '$(document).ready(function() {$(".board .col").click(function(event) {player_move(this.id, "X");});});';
            }
            // If user chooses to move second, computer makes first move
            else {
                $extra_js .= '$(document).ready(function() {computer_move("X"); $(".board .col").click(function(event) {player_move(this.id, "O");});});';
            }
        }
        
        $extra_js .= "</script>";
        echo $extra_js;
    ?>
</body>
</html>