<?php

    session_start();

    $username = $_SESSION["username"];

    if(array_key_exists('submit',$_POST)){

        $link = mysqli_connect('localhost','root','','game_db');

        if(mysqli_connect_error()) {
            die("There was a problem connecting to the database");
        }

        $query = "SELECT * FROM `hangman-game-scores` WHERE uname ='".$username."'";
        $result = mysqli_query($link,$query);

        if(mysqli_num_rows($result) > 0) {

            $query = "SELECT score FROM `hangman-game-scores` WHERE uname ='".$username."'";
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_array($result);
            $score = $row['score'];

            $current_score = intval($_COOKIE['hangmanScore']);

            if ($current_score > $score){
                $query = "UPDATE `hangman-game-scores` SET score = ".$current_score." WHERE uname = '".$username."'";
                mysqli_query($link,$query);
            }
        }
        else {
            $query = "INSERT INTO `hangman-game-scores` (`uname`, `score`) VALUES ('".$username."', ".intval($_COOKIE['reactionTimeScore']).")";
            mysqli_query($link,$query);
        }

        unset($_COOKIE['hangmanScore']);
        header("location: ../home.php");
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hangman</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&family=Tiro+Telugu&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <div class="container">
        <div class="headings">
            <h1>Game: Hangman</h1>
            <h2>User: <?php echo $username?></h2>
        </div>
        <div class="container-game">
            <div id="options-container"></div>
            <div id="letter-container" class="letter-container hide"></div>
            <div id="user-input-section"></div>
            <canvas id="canvas"></canvas>
            <div id="new-game-container" class="new-game-popup hide">
                <div id="result-text"></div>
                <button id="new-game-button">New Game</button>
            </div>
            <br><br>
            <div id="lives-container"></div>
        </div>
        <form method="post">
            <div class="buttons">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Exit Game</button>
                <a href="leaderboard.php" class="btn btn-primary" role="button">Show Leaderboard</a>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Script -->
    <script src="index.js"></script>
</body>

</html>