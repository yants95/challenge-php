<?php

namespace App\Core\External\Implementations;

use App\Core\External\Interfaces\AuthorizationServiceInterface;
use Illuminate\Support\Facades\Http;

class MockyAuthorizationService implements AuthorizationServiceInterface
{
    public function authorize()
    {
        $request = Http::get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        $response = json_decode($request, true);

        return $response["message"] === 'Autorizado';
    }
}
