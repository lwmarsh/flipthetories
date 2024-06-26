<?php 

require_once('./db_connect.php');

class Recommender {
    private $dbc;

    public function __construct($dbc) {
        $this->dbc = $dbc;
    }

    public function getRecommendation($searchedConstituency) {
        $query = "SELECT * FROM flip_the_tories WHERE LOWER(constituency) = LOWER(?)";
        $statement = $this->dbc->prepare($query);
        $statement->bind_param("s", $searchedConstituency);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows == 0) {
            throw new Exception("<div style='background-color: black;padding: 20px;'><p style='color: white;'>No data found for the specified constituency.</p><p style='color: white;'>Please check your spelling and try again.</p></div>");
        }

        while ($row = $result->fetch_assoc()) {
            $constituency = $row["constituency"];
            $recommendation = $row["recommendation"];
            $url = $row["url"];
            }
        
        if ($recommendation == "Sinn FÃ©in") {
            $recommendation = "Sinn Féin";
        }
        
        echo "<div style='background-color: " . $this->getBackgroundColour($recommendation) . "; border: solid " . $this->getBorderColour($recommendation) . " 5px;
        padding: 20px;'>";
        echo "<h3>Recommendation for $constituency:</h3>";
        echo "<p class='title'>$recommendation</h1>";
        echo "<p>For more information, visit the tactical.vote page for <a href='$url'target='_blank' rel='noopener noreferrer'>$constituency</a>.</p>";
        echo "</div>";
    }

    public function getBackgroundColour($recommendation) {
        switch ($recommendation) {
            case "Labour":
                return "#FF94B0";
            case "Liberal Democrat":
                return "#FAA61A";
            case "Green":
               return "#02A95B";
            case "Independent":
                return "#DCDCDC";
            case "Alliance":
                return "#F6CB2F";
            case "Social Democratic and Labour Party":
                return "#3BCE3E";
            case "Sinn Féin":
                return "#7CC0B7";
            case "Scottish National Party":
                return "#FDF38E";
            case "Plaid Cymru":
                return "#009696";
            default:
                return "White";
        }
    }

    public function getBorderColour($recommendation) {
        switch ($recommendation) {
            case "Labour":
                return "#E4003B";
            case "Liberal Democrat":
                return "#FAA61A";
            case "Green":
                return "#02A95B";
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
                return "Lightgray";
        }
    }
}

?>
