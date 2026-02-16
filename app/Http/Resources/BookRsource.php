<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookRsource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title"=> $this->title,
            "isbn"=> $this->isbn,
            "description"=> $this->description,
            "published_at"=> $this->publishedAt ,
            "totalCopies" => $this->totalCopies,
            "avaliable_copies"=> $this->isAvailable(),
            "cover_image"=> $this->image,
            "price"=> $this->price,
            "author_id"=> new AuthorResource($this->whenLoaded('Authore')),
            "genra"=> $this->genra,
        ];
    }
}
