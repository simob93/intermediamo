<?php
/**
 *  classe per per il record di testata, 
 */
class Immobile {
    public $id;
    public $dataAcquisto;
    public $annoCostruzione;
    public $dataRistutturato;
    public $costruitoDa;
    public $tipologia;
    public $mqNetti;
    public $mqComm;
    public $unitaTotali;
    public $piano;
    public $totPiani;
    public $esposizione;
    public $idContatto;
    public $composizioneEsterna;
    public $composizioneInterna;
}

class ComposizioneEsterna {
    public $giardino;
    public $mqGiardino;
    public $terrazzo;
    public $numeroTerrazzo;
    public $mqTerrazzo;
    public $balcone;
    public $numeroBalcone;
    public $mqBalcone;
    public $cannaFumaria;
    public $cappotto;
    public $pannelliSolari;
    public $fotovoltaico;
    public $postoAuto;
    public $idImmobileTe;


}

class ComposizioneInterna {
    public $ingressoDisbrigo;
    public $cucinaAbitabile;
    public $cucinotto;
    public $numeroTerrazzo;
    public $soggiornoCottura;
    public $soggiorno;
    public $cameraMatrimoniale;
    public $cameretta;
    public $studio;
    public $ripostiglio;
    public $sottoTetto;
    public $bagni;
    public $stube;
    public $idImmobileTe;
}

?>