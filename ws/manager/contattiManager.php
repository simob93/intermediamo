<?php 
include_once  '../config/db_config.php';
include_once  '../classi/contatti.php';
include_once  '../classi/listaAlfabetic.php';
include_once  '../generali/standard.php';
include_once  '../generali/costanti.php';

/**
 * manager per la gestione della operazioni 
 * legate alla tabella dei proprietari dell'immobile
 */
class ContattiManager {

    public $session;
    function getSession() {

        $dbConnection = new DbConnection();
        if ($dbConnection->getDbConnection() != null) {
            $this->session=$dbConnection->conn;
        }
        return $this->session;
    }
    /**
     *  metodo che ritorna una model, 
     *  formattato ad elenco telefonico
     *  raggruppato per lettere dell'alfabeto 
     */
    function listFormatted() {
        
        $listContatti = $this->getList(); 
        $result = array();
        if (isset($listContatti) && count($listContatti) > 0) {
            
            $tmpIndex = 0; 
            $previous = null; 
            $result = array(); 
            $alfabetic  = null;

            foreach ($listContatti as $value) {
                
               $firstLetter = substr($value->cognome, 0, 1);
               $change = $previous !== $firstLetter;
               if ($change) {
                   //costruisco il nodo principale
                   $alfabetic = new ListAlfabetic($firstLetter, array());
                   array_push($result, $alfabetic);
                   $tmpIndex++;
               } 
               //aggiungo al nodo "padre" i figli
               array_push($result[$tmpIndex -1] -> contatto, $value);
               $previous = $firstLetter;
           }
        }
        return $result;
    }
    /**
     * metodo che ritorna una lista ordinata per "cognome ASC"
     * della tabella contatti
     */
    function getList() {
        
        $data = null;
        $conn = null;
        try {

            $conn = $this -> getSession();
            $stmt = $conn -> prepare(
                "SELECT ID as id, NOME as nome, COGNOME as cognome, 
                DATADINASCITA as dataDiNascita, CODICEFISCALE as codFiscale 
                FROM contatti as c
				ORDER BY c.cognome ASC "
            );
            $stmt -> execute();
            $data = $stmt -> fetchAll(PDO::FETCH_CLASS, "Contatti");
           
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } 
        return $data;
    }
    /**
     *  controllo dei campi obbligatori per 
     *  necessari a fin che l'inserimento in tabella
     *  avvenga con successo
     */
    function checkCampiObbligatori($contatto) {
        
        if (Standard::isEmptyString($contatto->nome)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "nome"));   
        }
        if (Standard::isEmptyString($contatto->cognome)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "cognome"));   
        }
        if (Standard::isEmptyString($contatto->codiceFiscale)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "codiceFiscale"));   
        }
        if (Standard::isEmptyString($contatto->dataDiNascita)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "dataDiNascita"));   
        }
        if (Standard::isEmptyString($contatto->via)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "via"));   
        }
        if (Standard::isEmptyString($contatto->cap)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "cap"));   
        }
        if (Standard::isEmptyString($contatto->provincia)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "provincia"));   
        }
        if (Standard::isEmptyString($contatto->citta)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "citta"));   
        }
        if (Standard::isEmptyString($contatto->telefono)) {
            throw new Exception(sprintf(Costanti::FIELD_MISSING, "telefono"));   
        }
        return true;
    }
    
    function save($contatto) {
        $stmt = null;
        $conn = null;
        try {
            
            $conn = $this->getSession();
            if ($this->checkCampiObbligatori($contatto)) {
                $stmt = $conn -> prepare(
                    "INSERT INTO contatti (NOME, COGNOME, DATADINASCITA, CODICEFISCALE, EMAIL, TELEFONO, VIA, CAP, PROVINCIA, CITTA) 
                        VALUES (:NOME, :COGNOME, :DATADINASCITA, :CODICEFISCALE, :EMAIL, :TELEFONO, :VIA, :CAP, :PROVINCIA, :CITTA)"
                );
                $stmt->bindParam(':NOME', $contatto->nome);
                $stmt->bindParam(':COGNOME', $contatto->cognome);
                $stmt->bindParam(':DATADINASCITA', $contatto->dataDiNascita);
                $stmt->bindParam(':CODICEFISCALE', $contatto->codiceFiscale);
                $stmt->bindParam(':EMAIL', $contatto->email);
                $stmt->bindParam(':TELEFONO', $contatto->telefono);
                $stmt->bindParam(':VIA', $contatto->via);
                $stmt->bindParam(':CAP', $contatto->cap);
                $stmt->bindParam(':PROVINCIA', $contatto->provincia);
                $stmt->bindParam(':CITTA', $contatto->citta);
                $stmt -> execute();
            }
        } catch(Exception $e) {
            throw new Exception($e ->getMessage());
        } 
    }

    function update() {
        if ($this->checkCampiObbligatori($contatto)) {

        }
    }

    function delete() {

    }
}

?>