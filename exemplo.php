<?php

require_once "vendor/autoload.php";

use jerp86\DioCep\Search;

$busca = new Search;

$resultado = $busca->getAddressFromZipcode('18608262');

print_r($resultado);