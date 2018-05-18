<?php
class DbConnection {
    public  $conn = null;

    function getDbConnection() {
       
        if (!isset($this->conn)) {

            try {
                $dbh = new PDO('mysql:host=localhost;dbname=intermediamo', "root", "root");
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn = $dbh;
            } catch (PDOException $e) {
                $this->conn = null;
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        return $this->conn;
    }
}

?>