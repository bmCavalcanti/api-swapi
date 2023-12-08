<?php

namespace App\Log;

class LogController
{
    protected $logFolder = __DIR__.'/../../logs/';

    public function insert(array $request, array $response): array
    {
        $content = json_encode([
            'request' => $request,
            'response' => $response
        ]);

        $day = date('d-m-Y H-i-s');

        $folder = $this->logFolder.$day.'.json';

        try {
            fopen($folder, "w");
        } catch (\Exception $e) {
            return [
                'success' => false,
                'response' => $e->getMessage()
            ];
        }

        try {
            file_put_contents($folder, $content);
        } catch (\Exception $e) {
            return [
                'success' => false,
                'response' => $e->getMessage()
            ];
        }

        return [
            'success' => true,
            'response' => 'Log registrado com sucesso!'
        ];
    }
}