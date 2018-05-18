<?php
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
   
}
?>