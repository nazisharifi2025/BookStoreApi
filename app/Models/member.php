<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        'email',
        'address',
        'membership_date',
        'whatsApp_number',
        'status',
    ];
    protected $casts = [
        'membership_date',
    ];
   public function borrowing(){
    return $this->belongsTo(borrowing::class, 'member_id');
   }
   public function activBorroing(){
    return $this->borrowing()->where('status' , 'borrowed');
   }
}
