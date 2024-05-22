<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flip the Tories</title>
</head>
<body>
    <h1>FLIP THE TORIES</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once('./db_connect.php');
        require_once('./recommendation.php');

        $databaseConnector = new DatabaseConnector(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $databaseConnector->connect();
        $dbc = $databaseConnector->getConnection();

        $recommender = new Recommender($dbc);
        $constituency = $_POST["constituency"];
        $recommender->getRecommendation($constituency);
    
    echo "<p>Please enter your constituency:</p>
    <form action='' method='post'>
        <input type='text' name='constituency' placeholder='Enter your constituency'>
        <button type='submit'>Get Recommendation</button>
    </form>";
    } else {
    ?>
    
    <p>Please enter your constituency:</p>
    <form action="" method="post">
        <input type="text" name="constituency" placeholder="Enter your constituency">
        <button type="submit">Get Recommendation</button>
    </form>
    <?php
    }
    ?>
</body>
</html>
