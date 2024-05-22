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
        
        if ($recommendation == "Sinn FÃ©in") {
            $recommendation = "Sinn Féin";
        }
        
        echo "<div style='background-color: " . $this->getBackgroundColour($recommendation) . "; padding: 20px;'>";
        echo "<h2>Recommendation for $constituency:</h2>";
        echo "<p>$recommendation</p>";
        echo "</div>";
    }

    public function getBackgroundColour($recommendation) {
        switch ($recommendation) {
            case "Labour":
                return "#E4003B";
            case "Liberal Democrat":
                return "#FAA61A";
            case "Independent":
                return "#DCDCDC";
            case "Alliance":
                return "#F6CB2F";
            case "Social Democratic and Labour Party":
                return "#2AA82C";
            case "Sinn Féin":
                return "#326760";
            case "Scottish National Party":
                return "#FDF38E";
            case "Plaid Cymru":
                return "#005B54";
            default:
                return "White";
        }
    }
}

?>
