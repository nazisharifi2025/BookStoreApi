<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $authors = Author::with('book');
        return AuthorResource::collection($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $author = Author::create([
            "name"=> $request->name,
            "bio"=> $request->bio,
            "nationality"=> $request->nationality,
        ]);
        return response()->json([
            "created_author"=> $author
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $Author = Author::findOrfail($id);
       response()->json([
        "SingelAuthor"=> $Author,
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateAuthorRequest $request, string $id)
    {
       $author = Author::findOrfail($id);
       $author->update($request->validated());
       return response()->json([
        "UpdetedData"=> $author 
       ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $authorFind = Author::findOrfial($id);
        $authorFind->delete();
        return response()->json([
        "deletedAuthor"=> "one author deleted"
        ]);
    }
}
