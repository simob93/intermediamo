<?php 

include_once  '../manager/authManager.php';
include_once  '../classi/jsonResponse.php';
include_once  '../generali/costanti.php';
class AuthService {
    
    function getManager() {
        return new AuthManager();
    }
    
    function doLogin($user) {
        $success =true;
        $data = null;
        $messagge = array();
        //verifico il campo username
        if (Standard::isEmptyString($user->username)) {
            $data = new JsonResponse(false, array_push($messagge, sprintf(Costanti::FIELD_MISSING, "userame")), $data); 
            return $data -> jsonSerialize();
        }
        //verifico il campo password
        if (Standard::isEmptyString($user->password)) {
            $data = new JsonResponse(false, array_push($messagge, sprintf(Costanti::FIELD_MISSING, "password")), $data); 
            return $data -> jsonSerialize();
        }
        try {
            
            $data = $this->getManager()->doLogin($user);
            if (count($data) > 0) {
                array_push($messagge, Costanti::LOGIN_OK);
            } else {
                $success = false;
                array_push($messagge, Costanti::LOGIN_FAILED);
            }

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