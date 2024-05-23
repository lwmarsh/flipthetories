<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flip the Tories</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

<?php $backgroundColour = "#fff" ?>

    <div class="container" style="background-color: <?php echo $backgroundColour; ?>;">
    <h1>FLIP THE TORIES</h1>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('./db_connect.php');
        require_once('./recommendation.php');
    
    try {
        $databaseConnector = new DatabaseConnector(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $databaseConnector->connect();
        $dbc = $databaseConnector->getConnection();

        $recommender = new Recommender($dbc);
        $constituency = $_POST["constituency"];
        $recommender->getRecommendation($constituency);

    } catch (Exception $exception) {
        $errorMessage = $exception->getMessage();
        echo "$errorMessage";
    }
    
    echo "<p>Please enter your constituency:</p>
    <form action='' method='post'>
        <input type='text' name='constituency'>
        <button type='submit'>Get Recommendation</button>
    </form>";
    } else {
    ?>
    
    <p>Please enter your constituency:</p>
    <form action="" method="post">
        <input type="text" name="constituency">
        <button type="submit">Get Recommendation</button>
    </form>
    <?php
    }
    ?>
    <br>
    <small>All voting data is borrowed from <a href="https://tactical.vote/">tactical.vote</a>.</small>
    </div>
</body>
</html>
