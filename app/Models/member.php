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
    public function member(){
        $this->hasMany(member::class , 'member_id');
    }
}
