    </div> <!-- end div container -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <?php 
        if (isset($_SESSION["player_move"])) {
            if ($_SESSION["player_move"] == "X") {
                echo <<< MOV
                <script type="text/javascript">
                $(document).ready(function() {
                    $(".board .col").click(function(event) {
                        player_move(this.id, "X");
                    });    
                });
                </script>
MOV;
            }
            else {
                echo <<< MOV
                <script type="text/javascript">
                $(document).ready(function() {
                    computer_move("X");
            $(".board .col").click(function(event) {
                        player_move(this.id, "O");                              
                    });
                });
                </script>              
MOV;
            }
        }       
    ?>
</body>
</html>