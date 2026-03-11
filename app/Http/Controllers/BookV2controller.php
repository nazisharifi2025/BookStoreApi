<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookRsource;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;

class BookV2controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        try{
            if(!$request->user() || !$request->user()->tokenCan('read-book')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
            }
            $query = Book::with('Authors');
        if($request->has('search')){
            $search = $request->search;
            $query->where(function($q) use($search){
                $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE' , "%{$search}%")
                ->orWhereHas('Authors', function($authorQuery) use($search){
                    $authorQuery->where('name','LIKE', "%{$search}%");
                });
            });
        }
        $books = $query->paginate(10);
        return BookRsource::collection($books);
        }
        catch(Exception $err){
            return response()->json([
                "messege"=> "Somting Went Wrong",
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
