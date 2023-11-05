<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class Yanduan
{
    private $base_url;
    private $token;
    public function __construct()
    {
        $this->base_url = 'https://propam.admasolusi.space/';
        $this->request_token();
    }

    public function processed_reports($body)
    {
        $url = 'api/v2/pis/reports/processed-reports';
        return $this->post($url, $body);
    }

    public function getToken()
    {
        return $this->token;
    }

    public function request_token()
    {
        $url = 'api/v2/pis/generate-token';
        $body = null;
        $response = $this->post($url, null);
        $this->token = null;
        if ($response['status'] == 200)
            $this->token = $response['response']->data;
    }

    private function post($url, $body)
    {
        $response = Http::withHeaders([
            'Access-Key' => 'TThrauE38AOMq4rJKghhOi1BqOpAzyPiAgJQWdvyjlliiMAcdfqJkKo8x',
            'Secret-Key' => '02F0v4CFdNKGEFFxFckzKYQ9JlxSCPVPlcCoXOOwYzyBeV5ziF1U',
            'Token' => $this->token
        ])->post($this->base_url . $url, $body);
        $res = json_decode($response->body());
        return [
            'response' => $res,
            'status' => $response->status()
        ];
    }
}
