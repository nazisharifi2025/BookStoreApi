<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowing extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowingFactory> */
    use HasFactory;
    public function books(){
        $this->belongsToMany(Book::class , 'book_id');
    }
    public function member_borrowing(){
        $this->belongsToMany(member::class , 'member_id');
    }
}
