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
       return $this->belongsTo(Author::class , 'author_id');
    }
    public function borrowing(){
       return  $this->hasMany(borrowing::class , 'book_id');
    }
    public function isAvialble(){
        return $this->available_copies> 0 ;
    }
    public function barrow(){
        if($this->available_copies> 0){
            $this->decrement('available_copies');
        }
    }
    public function returnBook(){
        if($this->available_copies < $this->total_copies){
            $this->increment('available_copies');
        };
    }
}
