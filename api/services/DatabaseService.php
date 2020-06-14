<?php
class DatabaseService
{
    protected $db;

    public function __construct($dbHost, $dbName, $dbUser, $dbPassword)
    {
        $this->db = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName . ";charset=utf8", $dbUser, $dbPassword);
    }

    public function query($statement){
        $resultTable = array();

        try {
            $table = $this->db->query($statement, PDO::FETCH_ASSOC);
            foreach ($table as $key => $row){
                $resultTable[] = $row;
            }
        }
        catch (PDOException $exception){
            error_log("Query failed(check your query statement): " . $exception->getMessage() . "\n" . $statement);
            return $resultTable;
        }
        return $resultTable;
    }

}
