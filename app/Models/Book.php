<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    public function Authors(){
        $this->belongsToMany(Author::class , 'author_id');
    }
    public function borrowing(){
        $this->hasMany(borrowing::class , 'book_id');
    }
}
