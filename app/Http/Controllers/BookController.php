<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books =  Book::all();
        return response()->json([
            "books"=> $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $books = Book::create([
            "title"=> $request->title,
            "isbn"=> $request->isbn,
            "description"=> $request->description,
            "published_at"=> $request->publishedAt ,
            "cover_image"=> $request->image	,
            "price"=> $request->price,
            "author_id"=> $request->author_id,
            "genra"=> $request->genra,	
        ]);
        return response()->json([
            "createData"=> $books,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFial($id);
        return response()->json([
            "shoingData"=> $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateBook = Book::findOrFial($id);
        $updateBook->update([
            "title"=> $request->title,
            "isbn"=> $request->isbn,
            "description"=> $request->description,
            "published_at"=> $request->publishedAt ,
            "cover_image"=> $request->image	,
            "price"=> $request->price,
            "author_id"=> $request->author_id,
            "genra"=> $request->genra,
        ]);
        return response()->json()[
            "updatdBok"=> $updateBook,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
