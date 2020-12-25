<?php

use PHPUnit\Framework\TestCase;
use jerp86\DioCep\Search;

class SearchTest extends TestCase {
  /**
   * @dataProvider dadosTeste
   */
  public function testGetAddressFromZipcode(string $input, array $esperado) {
    $resultado = new Search;
    $resultado = $resultado->getAddressFromZipCode($input);

    $this->assertEquals($esperado, $resultado);
  }

  public function dadosTeste() {
    return [
      "Endereço Praça da Sé" => [
        "01001000",
        [
          "cep" => "01001-000",
          "logradouro" => "Praça da Sé",
          "complemento" => "lado ímpar",
          "bairro" => "Sé",
          "localidade" => "São Paulo",
          "uf" => "SP",
          "ibge" => "3550308",
          "gia" => "1004",
          "ddd" => "11",
          "siafi" => "7107"
        ],
      ],
      "Endereço Qualquer" => [
        "18608262",
        [
          'cep' => '18608-262',
          'logradouro' => 'Avenida Universitária',
          'complemento' => 'lado par',
          'bairro' => 'Residencial Vila Di Capri',
          'localidade' => 'Botucatu',
          'uf' => 'SP',
          'ibge' => '3507506',
          'gia' => '2240',
          'ddd' => '14',
          'siafi' => '6249',
        ],
      ],
      "Endereço aula" => [
        "03624010",
        [
            "cep" => "03624-010",
            "logradouro" => "Rua Luís Asson",
            "complemento" => "",
            "bairro" => "Vila Buenos Aires",
            "localidade" => "São Paulo",
            "uf" => "SP",
            "ibge" => "3550308",
            "gia" => "1004",
            "ddd" => "11",
            "siafi" => "7107"
        ],
      ],
    ];
  }
}