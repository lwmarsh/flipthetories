<?php 

include('./config.php');

class DatabaseConnector {
    private $host;
    private $username;
    private $password;
    private $dbName;
    private $dbConnection;

    public function __construct($host, $username, $password, $dbName) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;        
    }

    public function connect() {
        $this->dbConnection = new mysqli($this->host, $this->username, $this->password, $this->dbName);

        if ($this->dbConnection->connect_error) {
            die("Connection failed: " . $this->dbConnection->connect_error);
        }

        $this->dbConnection->set_charset("utf8");
    }

    public function getConnection() {
        return $this->dbConnection;
    }
}

$databaseConnector = new DatabaseConnector(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$databaseConnector->connect();
$dbc = $databaseConnector->getConnection();

?>