<?php

namespace App\Http\Controllers;

use App\Http\Resources\TextResource;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class GetTextController extends Controller
{
    #[OA\Get(path: '/api/texts/{id}', tags: ['text'], security: [['jwt' => []]])]
    #[OA\Parameter(
        name: 'id',
        in: 'path',
        required: true,
        description: 'Text ID',
        schema: new OA\Schema(type: 'string', format: 'uuid')
    )]
    #[OA\Response(
        response: 200,
        description: '',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'object', ref: '#/components/schemas/Text'),
            ]
        )
    )]
    #[OA\Response(response: '401', ref: '#/components/responses/401')]
    public function __invoke(Request $request, Text $text): JsonResource
    {
        return new TextResource($text);
    }
}
