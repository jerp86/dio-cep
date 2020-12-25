<?php

require_once "vendor/autoload.php";

use jerp86\DioCep\Search;

$busca = new Search;

/* Buscando informações pelo nº do CEP através do ViaCEP */
$resultado = $busca->getAddressFromZipcode('18608262');
echo '*** API ViaCEP ***' . PHP_EOL;
print_r($resultado);

/**
 * Buscando informações do endereço através de um texto, que pode ser sigla do
 * Estado, Cidade, Bairro, Rua e CEP, através do CEPlá
 */
$resultado = $busca->getAddressFromAddress('sp botucatu residencial vila di capri avenida universitária');
echo PHP_EOL . '*** API CEPlá ***' . PHP_EOL;
print_r($resultado);

/* Buscando informações pelo nº do CEP através do apiCEP */
$resultado = $busca->getAddressFromZipcode('18608262', 2);
echo PHP_EOL . '*** API apiCEP ***' . PHP_EOL;
print_r($resultado);