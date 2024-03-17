<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class Yanduan
{
    private $base_url;
    private $token;
    public function __construct()
    {
        $this->base_url = env('API_YANDUAN');
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

    public function importPangkat()
    {
        $url = 'api/v1/master/pangkat';
        return $this->get($url);
    }


    private function get($url)
    {
        $response = Http::withOptions(["verify"=>false])->get($this->base_url . $url);
        $res = json_decode($response->body());
        return $res;
    }

    private function post($url, $body)
    {
        $response = Http::withHeaders([
            'Access-Key' => 'pjQkbjJ8L7J2wdVL2JStwie326kprVbjzBOvHKDq0Y1hprSWgV',
            'Secret-Key' => 'ei61TC3R28VbsxXwVDlgjWxYT9IR3n4zlUl0pam1sk757rUmRc',
            'Token' => $this->token
        ])->withOptions(["verify"=>false])
        ->post($this->base_url . $url, $body);
        $res = json_decode($response->body());
        return [
            'response' => $res,
            'status' => $response->status()
        ];
    }
}
