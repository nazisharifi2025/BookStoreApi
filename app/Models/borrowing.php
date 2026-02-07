<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowing extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowingFactory> */
    use HasFactory;
    protected $fillable = [
        "book_id",
        'member_id',
        'borrowed_date',
        'due_date',
        'returned_date',
        'status',
    ];
    public function books(){
        $this->belongsToMany(Book::class , 'book_id');
    }
    public function member_borrowing(){
        $this->belongsTo(member::class , 'member_id');
    }
}
