<?php

namespace jerp86\DioCep\ws;

class ApiCep
{
    private $url = 'https://ws.apicep.com/cep.json?code=';

    public function get(string $zipCode): array
    {
        $get = file_get_contents($this->url . $zipCode);

        return (array) json_decode($get);
    }
}
