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
    public function index(Request $request)
    {

        $query = Author::with('Book');
        if($request->has('message')){
            $message = $query->message;
            $query->where(function($qu)use($message){
                $qu->where('name','LIKE',"%{$message}%")
                ->orWhereHas('Book', function($BookQuery) use($message){
                    $BookQuery->where('title', 'LIKE', "%{$message}%");
                });
            });
        }
        return  AuthorResource::collection($authors);
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
       return response()->json([
        "SingelAuthor"=> $Author,
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateAuthorRequest $request, string $id)
    {
        $author = Author::findOrFail($id);
       $author->update($request->validated());
       return response()->json([
        "UpdetedData"=> $author 
       ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json([
        "deletedAuthor"=> "one author deleted"
        ]);
    }
}
