<?php
/**
 * classe per la lista dei proprietari gia inseriti,
 * ordinada alfabeticamente
 */
class ListAlfabetic {
    public $lettera;
    public $contatto = array();
	
	public function __construct($lettera, $contatto){
        $this->lettera = $lettera;
        $this ->contatto = $contatto;
    }
}
?>