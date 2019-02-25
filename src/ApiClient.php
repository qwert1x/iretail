<?php

namespace AlexeyMakarov\IRetail;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ApiClient
{
    private $http;

    public function __construct(Client $client = null)
    {
        $this->http = $client;
        if (null === $client) {
            $this->http = new Client([
                'base_uri' => 'https://beta.i-retail.com/api/cloud-fiscal/order/create',
            ]);
        }
    }

    public function makeRequest(CashReceipt $cash): string
    {
        try {
            $response = $this->http->post(
                '',
                ['json' => $cash]
            );
            return $response->getBody()->getContents();
        } catch (BadResponseException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            \json_decode($response);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $response;
            }
            return \json_encode([
                'text' => $e->getResponse()->getReasonPhrase(),
                'code' => $e->getCode(),
            ]);
        }
    }
}
