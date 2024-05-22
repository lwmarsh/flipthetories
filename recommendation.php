<?php 

require_once('./db_connect.php');

class Recommender {
    private $dbc;

    public function __construct($dbc) {
        $this->dbc = $dbc;
    }

    public function getRecommendation($constituency) {
        $query = "SELECT * FROM results_2019 WHERE constituency = ?";
        $statement = $this->dbc->prepare($query);
        $statement->bind_param("s", $constituency);
        $statement->execute();
        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {
            $recommendation = $row["recommendation"];
            }

            echo $recommendation;

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recommender = new Recommender($dbc);
    $constituency = $_POST["constituency"];
    $recommender->getRecommendation($constituency);
}

?>
