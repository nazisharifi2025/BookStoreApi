<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    protected $fillable = [
        "title",
        "isbn",
        "description",
        "published_at",
        'totalCopies',
        'avaliable_copies',
        'cover_image',
        'status',
        'price',
        'author_id',
        'genra',
    ];
    public function Authors(){
        $this->belongsToMany(Author::class , 'author_id');
    }
    public function borrowing(){
        $this->hasMany(borrowing::class , 'book_id');
    }
}
