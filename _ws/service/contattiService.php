<?php 

include_once  '../manager/contattiManager.php';
include_once  '../classi/jsonResponse.php';
include_once  '../generali/costanti.php';
class ContattiService {
    
    function getManager() {
        return new ContattiManager();
    }  
    function save($contatto) {
        $success =true;
        $data = null;
        $messagge = array();
        
        try {
            
            $data = $this->getManager()->save($contatto);
            array_push($messagge, Costanti::OPERAZIONE_OK);

        } catch (Exception $e) {
            $success = false;
            array_push($messagge, Costanti::OPERAZIONE_KO, $e->getMessage());
        } finally {
            $data = new JsonResponse($success, $messagge, $data);
        }
        return $data -> jsonSerialize();
    }

    function getList() {
        $success =true;
        $data = null;
        $messagge = array();
        try {
            
            $data = $this->getManager()->getList();
            array_push($messagge, Costanti::OPERAZIONE_OK);

        } catch (Exception $e) {
            $success = false;
            array_push($messagge, Costanti::OPERAZIONE_KO, $e->getMessage());
        } finally {
            $data = new JsonResponse($success, $messagge, $data);
        }
        return $data -> jsonSerialize();
    }

    function listFormatted($search = null) {
        $success =true;
        $data = null;
        $messagge = array();
        try {
            
            $data = $this->getManager()->listFormatted($search);
            array_push($messagge, Costanti::OPERAZIONE_OK);

        } catch (Exception $e) {
            $success = false;
            array_push($messagge, Costanti::OPERAZIONE_KO, $e->getMessage());
        } finally {
            $data = new JsonResponse($success, $messagge, $data);
        }
        return $data -> jsonSerialize();
    }
}

?>