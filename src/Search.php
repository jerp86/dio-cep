<?php

namespace jerp86\DioCep;

class Search {
    private $url = "http://viacep.com.br/ws/";

    public function getAddressFromZipcode(string $zipCode, int $api = 1) : ?array {
        if (!preg_match('/^[0-9][0-9]*$/', $zipCode)) {
            // echo 'Zip Code is invalid! Insert only numbers, please';
            return null;
        }

        $zipCode = preg_replace('/[^0-9]/im', '', $zipCode);

        if (strlen($zipCode) <=> 8) {
            // echo 'The length of Zip Code is 8 numbers, please correct the information.';
            return null;
        }

        if ($api === 1) {
            $get = file_get_contents($this->url . $zipCode . "/json");
    
            return (array) json_decode($get);
        }
        
        if ($api === 2) {
            $this->url = 'https://ws.apicep.com/cep/';

            $get = file_get_contents($this->url . $zipCode . '.json');

            return (array) json_decode($get);
        }
    }

    public function getAddressFromAddress(string $address) : array {
        $this->url = 'http://cep.la/';
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        
        $context = stream_context_create($opts);

        $address = str_replace(' ', '-', $address);
        
        $file = file_get_contents($this->url . $address, false, $context);
        
        return (array) $file;
    }
}
