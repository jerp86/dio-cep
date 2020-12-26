<?php

namespace jerp86\DioCep;

use jerp86\DioCep\ws\ViaCep;
use jerp86\DioCep\ws\ApiCep;

class Search
{
    public function getAddressFromZipcode(string $zipCode, int $api = 1): ?array
    {
        if (!preg_match('/^[0-9][0-9]*$/', $zipCode)) {
            $err[0] = 'Zip Code is invalid! Insert only numbers, please';
            return $err;
        }

        $zipCode = preg_replace('/[^0-9]/im', '', $zipCode);

        if (strlen($zipCode) <=> 8) {
            $err[0] = 'The length of Zip Code is 8 numbers, please correct the information.';
            return $err;
        }

        if ($api === 1) {
            return $this->getFromViaCep($zipCode);
        }

        if ($api === 2) {
            return $this->getFromApiCep($zipCode);
        }

        $err[0] = 'Zip Code is invalid! Please verify your input';
        return $err;
    }

    private function getFromViaCep(string $zipCode): array
    {
        $get = new ViaCep();

        return $get->get($zipCode);
    }

    private function getFromApiCep(string $zipCode): array
    {
        $get = new ApiCep();

        return $get->get($zipCode);
    }

    public function getAddressFromAddress(string $address): array
    {
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
