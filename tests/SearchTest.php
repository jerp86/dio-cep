<?php

use PHPUnit\Framework\TestCase;
use jerp86\DioCep\Search;

class SearchTest extends TestCase {
  /**
   * @dataProvider dadosTeste
   * @covers jerp86\DioCep\Search
   */
  public function testGetAddressFromZipcode(string $input, array $esperado) {
    $resultado = new Search;
    
    /* testando a apiCEP */
    if (preg_match('/º/', $input)) {
      
      $input = preg_replace('/[^0-9]/im', '', $input);
      
      $resultado = $resultado->getAddressFromZipCode($input, 2);
      
      $this->assertEquals($esperado, $resultado);
      return;
    }

    /* Validando se o insert é apenas númemros */
    if (!preg_match('/^[0-9][0-9]*$/', $input)) {
      $resultado = $resultado->getAddressFromZipCode($input);
      $esperado = null;
    
      $this->assertEquals($esperado, $resultado);
      return;
    }

    $resultado = $resultado->getAddressFromZipCode($input);

    /* verificando o tamanho do input */
    if (strlen($input) <=> 8) {
      $esperado = null;
    }
    
    $this->assertEquals($esperado, $resultado);
  }

  /**
   * @dataProvider textoTeste
   * @covers jerp86\DioCep\Search
   */
  public function testGetAddressFromAddress(string $input, array $esperado) {
    $resultado = new Search;
    $resultado = $resultado->getAddressFromAddress($input);

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
      "2º Endereço Praça da Sé" => [
        "º01001000",
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
      "2º Endereço Qualquer" => [
        "º18608262",
        [
          "status" => 200,
          "ok" => true,
          "code" => "18608-262",
          "state" => "SP",
          "city" => "Botucatu",
          "district" => "Residencial Vila Di Capri",
          "address" => "Avenida Universitária - lado par",
          "statusText" => "ok"
        ],
      ],
      "2º Endereço da aula" => [
        "º03624010",
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
      "Validando o texto de entrada" => [
        "Aqui será texto ao invés de números",
        [
          'Zip Code is invalid! Insert only numbers, please',
        ]
      ],
      "Validando a quantia de números digitados" => [
        "123456789",
        [
          'The length of Zip Code is 8 numbers, please correct the information.',
        ]
      ],
    ];
  }

  public function textoTeste() {
    return [
      "Endereço Praça da Sé" => [
        "são paulo Sé Praça da Sé - lado ímpar",
        [
          '[{"cep":"01001000","uf":"SP","cidade":"São Paulo","bairro":"Sé","logradouro":"Praça da Sé - lado ímpar"}]'
        ]
      ],
      "Endereço Qualquer" => [
        "são paulo vila buenos aires rua luís asson",
        [
          '[{"cep":"03624010","uf":"SP","cidade":"São Paulo","bairro":"Vila Buenos Aires","logradouro":"Rua Luís Asson"}]'
        ],
      ],
    ];
  }
}