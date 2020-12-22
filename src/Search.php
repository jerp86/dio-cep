<?php

namespace jerp86\DioCep;

class Search {
    private $url = "http://viacep.com.br/ws/";

    public function getAddressFromZipcode(string $zipCode) : array {
        $zipCode = preg_replace('/[^0-9]/im', '', $zipCode);

        $get = file_get_contents($this->url . $zipCode . "/json");

        return (array) json_decode($get);
    }
}