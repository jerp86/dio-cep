<?php

require_once "vendor/autoload.php";

use jerp86\DioCep\Search;

$busca = new Search;

/* Buscando informações pelo nº do CEP através do ViaCep */
$resultado = $busca->getAddressFromZipcode('18608262');
print_r($resultado);

/**
 * Buscando informações do endereço através de um texto, que pode ser sigla do
 * Estado, Cidade, Bairro, Rua e CEP, através do CEP lá
 */
$resultado = $busca->getAddressFromAddress('sp botucatu residencial vila di capri avenida universitária');
print_r($resultado);
