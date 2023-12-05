<?php

use Acme\classes\Rekening;

require "../vendor/autoload.php";

$idTafel = $_GET['idtafel'] ?? null;
if ($idTafel) {

    //TODO: bestelling ophalen en tonen op een mooie manier door gebruik te maken van Rekening.php
    $rekening = new Rekening($idTafel);


    //TODO: bestelling op betaald zetten

} else {
    http_response_code(404);
    include('error_404.php');
    die();
}