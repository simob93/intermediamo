<?php 

class Standard {
    function isEmptyString($string) {
        $app = trim($string);
        return $app === "";
    } 
    function encodeToMyClass($data, $class) {
        foreach ($data as $key => $value) {
            if (property_exists($class, $key)) {
                $class->{$key} = $value;
            } else {
                throw new Exception(sprintf(Costanti::PROPERTY_MISSING, $key));
            }   
        }
        return $class;
    }
}

?>