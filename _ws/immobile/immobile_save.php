<?php

include_once  '../manager/immobileManager.php';
include_once  '../service/immobileService.php';
include_once  '../classi/immobile.php';
include_once  '../generali/standard.php';

header('Content-type: application/json');
$request_body = file_get_contents('php://input');

$data = json_decode($request_body);
//record di testata
$immobile = new Immobile();
$composizioneEsterna = new ComposizioneEsterna();
$composizioneInterna = new ComposizioneInterna();

$immobileService = new ImmobileService();

try {
    $immobile= Standard::encodeToMyClass($data, $immobile);
    //record di composizione esterna
    if (isset($immobile->composizioneEsterna)) {
        $immobile->composizioneEsterna = Standard::encodeToMyClass($immobile->composizioneEsterna, $composizioneEsterna);
    }
    //record di composizione interna
    if (isset($immobile->composizioneInterna)) {
        $immobile->composizioneInterna = Standard::encodeToMyClass($immobile->composizioneInterna, $composizioneInterna);
    }
} catch(Exception $e) {

    die($e->getMessage());
}
$result = $immobileService -> save($immobile);
echo $result;
?>

