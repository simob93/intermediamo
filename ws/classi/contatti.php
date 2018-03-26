<?php 
/**
 * classe per la lista dei proprietari,
 * model principale
 * 
 */
class Contatti {
    public $id;
    public $nome;
    public $cognome;
    public $dataDiNascita;
    public $codiceFiscale;
    public $email;
    public $via;
    public $cap;
    public $provincia;
    public $telefono;
    public $citta;
    public $alias;

    public function __construct(){
        $nome = $this->nome;
        $cognome = $this->cognome;
        //avatar simone bertami = SB prima lettera del nome e prima lettera del cognome
        $this->alias = substr($nome, 0 ,1) ."". substr($cognome, 0 ,1);  
    }
    
    public function setContatto($id, $nome, $cognome, $dataDiNascita, $codiceFiscale, $email, $via, $cap, $provincia, $telefono, $citta){
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->dataDiNascita = $dataDiNascita;
        $this->codiceFiscale = $codiceFiscale;
        $this->email = $email;
        $this->via = $via;
        $this->cap = $cap;
        $this->provincia = $provincia;
        $this->telefono = $telefono;
        $this->citta = $citta;
    }
}

?>