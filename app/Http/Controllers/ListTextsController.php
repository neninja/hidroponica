<?php

namespace App\Http\Controllers;

use App\Http\Resources\TextResource;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListTextsController extends Controller
{
    #[OA\Get(path: '/api/texts', tags: ['text'], security: [['jwt' => []]])]
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
    public function __invoke(Request $request): JsonResource
    {
        $query = QueryBuilder::for(Text::class)
            ->allowedFilters([
                'name',
                AllowedFilter::exact('name'),
            ]);

        $texts = $query->allowedSorts('created_at')
            ->paginate(request()->query('limit', self::DEFAULT_PAGINATION_LIMIT));

        return TextResource::collection($texts);
    }
}
