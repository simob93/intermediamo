<?php

include_once '../service/contattiService.php';

header('Content-type: application/json');
$contattiService = new ContattiService();
$result = $contattiService ->listFormatted(isset($_GET["text"]) ? $_GET["text"] : null);
echo $result;
?>