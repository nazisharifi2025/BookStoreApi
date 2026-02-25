<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MembersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=> $this->name,
            'email'=>$this->email,
            'address'=>$this->address,
            'membership_date'=>$this->membership_data,
            'whatsApp_number'=>$this->whatsApp_number,
            'status'=> $this->status,
            "Borrow_count"=>$this->when(
                $this->relationLoaded('activBorroing'),
                $this->activBorroing()->count()
            ),
        ];
    }
}
