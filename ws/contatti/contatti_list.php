<?php

include_once '../service/contattiService.php';

header('Content-type: application/json');
$contattiService = new ContattiService();
$result = $contattiService ->listFormatted();
echo $result;
?>