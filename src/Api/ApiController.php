<?php
namespace App\Api;

use App\Log\LogController;

class ApiController
{
    protected $url;

    public function get(string $id)
    {
        $url = (string)$this->url.$id;

        $request = curl_init();

        curl_setopt_array($request, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
        ));

        $curlResponse = curl_exec($request);

        $log = new LogController();

        if ($curlResponse === false) {
            return json_encode([
                'success' => false,
                'message' => 'Nao foi possivel realizar a consulta',
                'error' => curl_error($request)
            ]);
        }

        $insertLog = $log->insert(curl_getinfo($request), json_decode($curlResponse, true));

        if ($insertLog['success'] == false) {
            return json_encode([
                'success' => false,
                'message' => 'Consulta realizada com sucesso, mas nao foi possivel gerar o log da consulta.',
                'response' => $curlResponse,
                'logResponse' => $insertLog['response']
            ]);

        }

        curl_close($request);
        return json_encode([
            'success' => true,
            'response' => $curlResponse
        ]);
    }
}