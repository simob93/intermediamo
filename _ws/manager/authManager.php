<?php 
include_once  '../config/db_config.php';
include_once  '../classi/pwd.php';
include_once  '../generali/standard.php';
include_once  '../generali/costanti.php';

/**
 * manager per la gestione della operazioni 
 * legate alla tabella di Autenticazione "password"
 */
class AuthManager {

    public $session;
    function getSession() {

        $dbConnection = new DbConnection();
        if ($dbConnection->getDbConnection() != null) {
            $this->session=$dbConnection->conn;
        }
        return $this->session;
    }
    
    function doLogin($user) {
        
        $username = $user->username;
        $password = $user->password;

        $data = null;
        $conn = null;
        try {

            $conn = $this -> getSession();
            $stmt = $conn -> prepare(
                "SELECT ID as id, USERNAME as username, PASSWORD as password 
                FROM pwd as p
                WHERE p.USERNAME=:USERNAME AND p.PASSWORD=:PASSWORD"
            );
            $stmt->bindParam(':USERNAME', $username);
            $stmt->bindParam(':PASSWORD', $password);
            $stmt -> execute();
            $data = $stmt -> fetchAll(PDO::FETCH_CLASS, "Pwd");
           
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } 
        return $data;
    }
   
}

?>