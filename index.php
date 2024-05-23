<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flip the Tories</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container">
    <p class="title">FLIP THE TORIES</p>
    <h4>Who do you need to vote for to unseat the Tories on 4th July 2024?</h4>
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
    
    echo "<br><form action='' method='post'>
        <input type='text' name='constituency' class='input-box' placeholder='Enter your constituency'>
        <button type='submit' class='recommend-button'>Get Recommendation</button>
    </form>";
    } else {
    ?>
    
    <form action="" method="post">
        <input type="text" name="constituency" class="input-box" placeholder="Enter your constituency">
        <button type="submit" class="recommend-button">Get Recommendation</button>
    </form>
    <?php
    }
    ?>
    <br>
    <small>Don't know your constituency? Search for your postcode on this <a href="https://www.theguardian.com/politics/ng-interactive/2024/jan/16/find-your-constituency-uk-general-election-2024-boundary-changes-votes-map-postcode" target="_blank" rel="noopener noreferrer">interactive map</a>.</small>
    <br>
    <small>All voting data is borrowed from <a href="https://tactical.vote/" target="_blank" rel="noopener noreferrer">tactical.vote</a>.</small>
    </div>
</body>
</html>