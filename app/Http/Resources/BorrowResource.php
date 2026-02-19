<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        "book_id" =>$this->book_id,
        'member_id'=> $this->membere_id,
        'borrowed_date'=>$this->borrowed_data,
        'due_date'=>$this->due_date,
        'returned_date'=>$this->returned_date,
        'status'=>$this->status,
        ];
    }
}
