<?php

namespace App\Models;

use Carbon\Carbon;
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
    protected $casts = [
         'borrowed_date',
        'due_date',
        'returned_date',
    ];
    public function books(){
        $this->belongsTo(Book::class);
    }
    public function member_borrowing(){
        $this->belongsTo(member::class);
    }
    public function isOverdue(){
        return $this->cue_date < Carbon::today() && $this->status === "borrowed";
    }
}
