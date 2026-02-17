<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Resources\BookRsource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('Authors')->paginate(10);
        return BookRsource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        $books = Book::create($request->validated());
        $books->load("authors");
        return new BookRsource($books);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return response()->json([
            "shoingBook"=> $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateBookRequest $request, string $id)
    {
        $updateBook = Book::findOrFail($id);
        $updateBook->update($request->validate());
        return response()->json([
            "updatdBok"=> $updateBook,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $findBook = Book::findOrFial($id);
        $findBook->delete();
        return response()->json([
            "deletedbook"=> $findBook,
        ]);
    }
}
