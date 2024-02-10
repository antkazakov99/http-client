<?php

namespace Ant\Http;

class Client
{
    public function request(Request $request): Response
    {
        $curlHandle = curl_init($request->getUri());
        $headers = [];
        $headerCallback = function ($curlHandle, $header) use (&$headers) {
            if (count(explode(':', $header)) === 2) {
                $headerData = explode(':', trim($header));
                $headers[$headerData[0]] = trim($headerData[1]);
            }
            return strlen($header);
        };

        curl_setopt_array(
            $curlHandle,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADERFUNCTION => $headerCallback,
                CURLOPT_HTTPHEADER => array_map(
                    fn($key, $value) => $key . ': ' . $value,
                    array_keys($request->getHeaders()),
                    $request->getHeaders()
                )
            ]
        );

        if (!is_null($request->getBody())) {
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $request->getBody());
        }

        // Method setting
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, $request->getMethod()->value);

        $responseBody = curl_exec($curlHandle) ?: null;
        $statusCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

        return new Response($statusCode, $headers, $responseBody);
    }
}
