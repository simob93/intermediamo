<?php

include_once  '../manager/contattiManager.php';
include_once  '../service/contattiService.php';
include_once  '../classi/contatti.php';
include_once  '../generali/standard.php';

header('Content-type: application/json');
$request_body = file_get_contents('php://input');

$data = json_decode($request_body);

$contatto = new Contatti();
$contattiService = new ContattiService();

$contatto = Standard::encodeToMyClass($data, $contatto);

//$contatto->setContatto(null, $nome, $cognome, $dataDiNascita, $codiceFiscale, $email, $via, $cap, $provincia, $telefono, $citta);

$result = $contattiService -> save($contatto);
echo $result;

?>
