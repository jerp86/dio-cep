<?php

use PHPUnit\Framework\TestCase;
use jerp86\DioCep\ws\ViaCep;

class ViaCepTest extends TestCase
{
  /**
  * @dataProvider dadosTeste
  * @covers jerp86\DioCep\ws\ViaCep
  */
  public function testGet(string $input, array $esperado)
  {
    $resultado = new ViaCep;
    $resultado = $resultado->get($input);
    
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
      "Endereço da aula" => [
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
