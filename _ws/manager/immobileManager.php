<?php 
include_once  '../config/db_config.php';
include_once  '../classi/immobile.php';
include_once  '../generali/standard.php';
include_once  '../generali/costanti.php';

/**
 * manager per la gestione della operazioni 
 * legate alla tabella di Autenticazione "password"
 */
class ImmobileManager {

    public $session;
    function getSession() {

        $dbConnection = new DbConnection();
        if ($dbConnection->getDbConnection() != null) {
            $this->session=$dbConnection->conn;
        }
        return $this->session;
    }
    /**
     *  @param $immobile
     */
    function save($immobile) {
        
        $data = null;
        $conn = null;
        try {
            $conn = $this -> getSession();
            $stmt = $conn -> prepare(
                "INSERT INTO immobile_te (DATA_ACQUISTO, ANNOCOSTRUZIONE, 
                DATA_RISTRUTTURATO, COSTRUITODA, TIPOLOGIA, MQNETTI, 
                MQCOMM, UNITATOT, PIANO, TOTPIANI, ESPOSIZIONE,IDCONTATTO)
                VALUES (:DATA_ACQUISTO, :ANNOCOSTRUZIONE, :DATA_RISTRUTTURATO, :COSTRUITODA, :TIPOLOGIA, :MQNETTI, :MQCOMM, :UNITATOT, :PIANO, :TOTPIANI, :ESPOSIZIONE, :IDCONTATTO)"
            );
            $stmt->bindParam(':DATA_ACQUISTO', $immobile->dataAcquisto);
            $stmt->bindParam(':ANNOCOSTRUZIONE', $immobile->annoCostruzione);
            $stmt->bindParam(':DATA_RISTRUTTURATO', $immobile->dataRistutturato);
            $stmt->bindParam(':COSTRUITODA', $immobile->costruitoDa);
            $stmt->bindParam(':TIPOLOGIA', $immobile->tipologia);
            $stmt->bindParam(':MQNETTI', $immobile->mqNetti);
            $stmt->bindParam(':MQCOMM', $immobile->mqComm);
            $stmt->bindParam(':UNITATOT', $immobile->unitaTot);
            $stmt->bindParam(':PIANO', $immobile->piano);
            $stmt->bindParam(':TOTPIANI', $immobile->totPiani);
            $stmt->bindParam(':ESPOSIZIONE', $immobile->esposizione);
            $stmt->bindParam(':IDCONTATTO', $immobile->idContatto);
            
            $stmt -> execute();

            //recupero l'ultimo id inserito del record di testata
            $idTe = $conn->lastInsertId();
            
            //procedo con l'inserimento delle tabelle secondarie
            if (isset($idTe) && isset($immobile->composizioneEsterna)) {
                $composizioneEsterna = $immobile->composizioneEsterna;
                $stmt = $conn -> prepare(
                    "INSERT INTO immobile_esterno (GIARDINO, MQGIARDINO, 
                    TERRAZZO, MQTERRAZZO, NUMEROTERRAZZO, BALCONE, 
                    NUMEROBALCONE, MQBALCONE, CANNAFUMARIA, CAPPOTTO, PANNELLISOLARI,FOTOVOLTAICO, POSTOAUTO, ID_IMMOBILE_TE)
                    VALUES (:GIARDINO, :MQGIARDINO, :TERRAZZO, :MQTERRAZZO, :NUMEROTERRAZZO,
                     :BALCONE, :NUMEROBALCONE, :MQBALCONE, :CANNAFUMARIA, :CAPPOTTO, :PANNELLISOLARI, :FOTOVOLTAICO, :POSTOAUTO, :ID_IMMOBILE_TE)"
                );
                $stmt->bindParam(':GIARDINO', Standard::isTrueValue($composizioneEsterna->giardino));
                $stmt->bindParam(':MQGIARDINO', $composizioneEsterna->mqGiardino);
                $stmt->bindParam(':TERRAZZO', Standard::isTrueValue($composizioneEsterna->terrazzo));
                $stmt->bindParam(':MQTERRAZZO', $composizioneEsterna->mqTerrazzo);
                $stmt->bindParam(':NUMEROTERRAZZO', $composizioneEsterna->numeroTerrazzo);
                $stmt->bindParam(':BALCONE', Standard::isTrueValue($composizioneEsterna->balcone));
                $stmt->bindParam(':NUMEROBALCONE', $composizioneEsterna->numeroBalcone);
                $stmt->bindParam(':MQBALCONE', $composizioneEsterna->mqBalcone);
                $stmt->bindParam(':CANNAFUMARIA', Standard::isTrueValue($composizioneEsterna->cannaFumaria));
                $stmt->bindParam(':CAPPOTTO', Standard::isTrueValue($composizioneEsterna->cappotto));
                $stmt->bindParam(':PANNELLISOLARI', Standard::isTrueValue($composizioneEsterna->pannelliSolari));
                $stmt->bindParam(':FOTOVOLTAICO', Standard::isTrueValue($composizioneEsterna->fotovoltaico));
                $stmt->bindParam(':POSTOAUTO', Standard::isTrueValue($composizioneEsterna->postoAuto));
                $stmt->bindParam(':ID_IMMOBILE_TE', $idTe);
                $stmt ->execute();
            }

            if (isset($idTe) && isset($immobile->composizioneInterna)) {
                $composizioneInterna = $immobile->composizioneInterna;
                $stmt = $conn -> prepare(
                    "INSERT INTO immobile_interno (INGRESSODISBRIGO, CUCINAABITABILE, 
                    CUCINOTTO, SOGGIORNOCOTTURA, SOGGIORNO, CAMERAMATRIMONIALE, 
                    CAMERETTA, STUDIO, RIPOSTIGLIO, SOTTOTETTO, BAGNI, STUBE, ID_IMMOBILE_TE)
                    VALUES (:INGRESSODISBRIGO, :CUCINAABITABILE, :CUCINOTTO, :SOGGIORNOCOTTURA, :SOGGIORNO, :CAMERAMATRIMONIALE,
                     :CAMERETTA, :STUDIO, :RIPOSTIGLIO, :SOTTOTETTO, :BAGNI, :STUBE, :ID_IMMOBILE_TE)"
                );
                $stmt->bindParam(':INGRESSODISBRIGO', Standard::isTrueValue($composizioneInterna->ingressoDisbrigo));
                $stmt->bindParam(':CUCINAABITABILE', Standard::isTrueValue($composizioneInterna->cucinaAbitabile));
                $stmt->bindParam(':CUCINOTTO', Standard::isTrueValue($composizioneInterna->cucinotto));
                $stmt->bindParam(':SOGGIORNOCOTTURA', Standard::isTrueValue($composizioneInterna->soggiornoCottura));
                $stmt->bindParam(':SOGGIORNO', Standard::isTrueValue($composizioneInterna->soggiorno));                
                $stmt->bindParam(':CAMERAMATRIMONIALE', Standard::isTrueValue($composizioneInterna->cameraMatrimoniale));
                $stmt->bindParam(':CAMERETTA', Standard::isTrueValue($composizioneInterna->cameretta));
                $stmt->bindParam(':STUDIO', Standard::isTrueValue($composizioneInterna->studio));
                $stmt->bindParam(':RIPOSTIGLIO', Standard::isTrueValue($composizioneInterna->ripostiglio));
                $stmt->bindParam(':SOTTOTETTO', Standard::isTrueValue($composizioneInterna->sottoTetto));
                $stmt->bindParam(':STUBE', Standard::isTrueValue($composizioneInterna->stube));                
                $stmt->bindParam(':BAGNI', Standard::isTrueValue($composizioneInterna->bagni));
                $stmt->bindParam(':ID_IMMOBILE_TE', $idTe);
                $stmt ->execute();
            }
           
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        } 
        return $data;
    }
   
}

?>