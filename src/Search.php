<?php

namespace jerp86\DioCep;

class Search {
    private $url = "http://viacep.com.br/ws/";

    public function getAddressFromZipcode(string $zipCode) : array {
        $zipCode = preg_replace('/[^0-9]/im', '', $zipCode);

        $get = file_get_contents($this->url . $zipCode . "/json");

        return (array) json_decode($get);
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
        return (array) json_decode($file);
    }
}
