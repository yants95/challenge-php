<?php

namespace App\External\Implementations;

use App\External\Interfaces\AuthorizationServiceInterface;

class MockyAuthorizationService implements AuthorizationServiceInterface
{
    public function authorize()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://run.mocky.io']);

        $response = $client->request('GET', '/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6', ['allow_redirects' => false]);

        return $response->getStatusCode() === 200;
    }
}
