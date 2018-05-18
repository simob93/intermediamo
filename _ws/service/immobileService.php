<?php 

include_once  '../manager/immobileManager.php';
include_once  '../classi/jsonResponse.php';
include_once  '../generali/costanti.php';
class ImmobileService {
    
    function getManager() {
        return new ImmobileManager();
    }
    /**
     * @param $immobile
     */
    function save($immobile) {
        $success =true;
        $data = null;
        $messagge = array();
        try {
            
            $data = $this->getManager()->save($immobile);
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