<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Text',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'audio', type: 'string'),
        new OA\Property(property: 'language', type: 'string'),
        new OA\Property(property: 'is_active', type: 'boolean'),
        new OA\Property(property: 'sentences', type: 'array', items: new OA\Items(ref: '#/components/schemas/Sentence')),
    ]
)]
class TextResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'audio' => $this->audio,
            'language' => $this->language,
            'is_active' => $this->is_active,
            'sentences' => SentenceResource::collection($this->sentences),
        ];
    }
}
