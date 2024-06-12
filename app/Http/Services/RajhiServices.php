<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class RajhiServices {

    private $base_url;
    private $headers;
    private $request_clint;


    public function __construct(Client $request_clint)
    {
        $this->request_clint = $request_clint;
        $this->base_url = env('rajhi_base_url');
        $this->headers = [
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer '. env('rajhi_token')
        ];
    }
}