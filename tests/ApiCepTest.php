<?php

use PHPUnit\Framework\TestCase;
use jerp86\DioCep\ws\ApiCep;

class ApiCepTest extends TestCase
{
  /**
  * @dataProvider dadosTeste
  * @covers jerp86\DioCep\ws\ApiCep
  */
  public function testGet(string $input, array $esperado)
  {
    $resultado = new ApiCep;
    $resultado = $resultado->get($input);
    
    $this->assertEquals($esperado, $resultado);
  }
  
  public function dadosTeste() {
    return [
      "Endereço Praça da Sé" => [
        "01001000",
        [
          "status" => 200,
          "ok" => true,
          "code" => "01001-000",
          "state" => "SP",
          "city" => "São Paulo",
          "district" => "Sé",
          "address" => "Praça da Sé - lado ímpar",
          "statusText" => "ok"        
        ],
      ],
      "Endereço da aula" => [
        "03624010",
        [
          "status" => 200,
          "ok" => true,
          "code" => "03624-010",
          "state" => "SP",
          "city" => "São Paulo",
          "district" => "Vila Buenos Aires",
          "address" => "Rua Luís Asson",
          "statusText" => "ok"        
        ],
      ],
    ];
  }
}
