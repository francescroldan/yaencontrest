<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdvertisementGetController
{
    public function __construct()
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'title' => 'Titulo',
                'description' => 'Descripcion',
                'price' => 12.1,
                'locality' => 'Localidad',
                'owner' => [
                    'type' => 1,
                    'name' => 'Nombre',
                    'phone' => 'Telefono',
                    'email' => 'Email'
                ]
            ],
            200,
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}
