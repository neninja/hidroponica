<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Sentence',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'content', type: 'string'),
        new OA\Property(property: 'translated_sentences', type: 'array', items: new OA\Items(ref: '#/components/schemas/TranslatedSentence')),
    ]
)]
class SentenceResource extends JsonResource
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
            'content' => $this->content,
            'translated_sentences' => TranslatedSentenceResource::collection($this->translatedSentences),
        ];
    }
}
