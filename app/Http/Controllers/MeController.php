<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class MeController extends Controller
{
    #[OA\Get(path: '/api/me', tags: ['user'], security: [['jwt' => []]])]
    #[OA\Response(
        response: 200,
        description: '',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'object', ref: '#/components/schemas/User'),
            ]
        )
    )]
    #[OA\Response(response: '401', ref: '#/components/responses/401')]
    public function __invoke(Request $request): JsonResource
    {
        return new UserResource($request->user());
    }
}
