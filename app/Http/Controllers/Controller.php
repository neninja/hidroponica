<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(title: 'Hidroponica', version: '0.0.0')]
#[OA\Schema(
    schema: 'Error',
    type: 'object',
    properties: [
        new OA\Property(property: 'code', type: 'string'),
        new OA\Property(property: 'message', type: 'string'),
        new OA\Property(
            property: 'data',
            oneOf: [
                new OA\Schema(type: 'object'),
                new OA\Schema(type: 'array', items: new OA\Items(type: 'object')),
            ],
        ),
    ]
)]
#[OA\Components(
    securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: 'jwt',
            description: 'Token de autenticação',
            type: 'http',
            scheme: 'bearer',
            bearerFormat: 'JWT',
        ),
    ],
    responses: [
        new OA\Response(
            null,
            response: 401,
            description: 'Unauthorized',
            content: new OA\JsonContent(ref: '#/components/schemas/Error')
        ),
    ]
)]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public const DEFAULT_PAGINATION_LIMIT = 50;
}
