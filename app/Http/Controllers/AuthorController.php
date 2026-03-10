<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Exception;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
            }
        $query = Author::with('Book');
        if($request->has('search')){
            $search = $request->search;
            $query->where(function($qu)use($search){
                $qu->where('name','LIKE',"%{$search}%")
                ->orWhereHas('Book', function($BookQuery) use($search){
                    $BookQuery->where('title', 'LIKE', "%{$search}%");
                });
            });
        }
        $authors = $query->paginate(5);
        return  response()->json($authors);
        }
        catch(Exception $err){
            return $err ;
        }
    }  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     try{
           //
           if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
           }
        $author = Author::create([
            "name"=> $request->name,
            "bio"=> $request->bio,
            "nationality"=> $request->nationality,
        ]);
        return response()->json([
            "created_author"=> $author
        ]);
     }
     catch(Exception $error){
        return response()->json($error);
     }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
      try{
        if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
        }
         $Author = Author::findOrfail($id);
       return response()->json([
        "SingelAuthor"=> $Author,
       ]);
      }
      catch(Exception $err){
        return response()->json([
            "message"=> "Author with ". $id . " not found"
        ]);
      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateAuthorRequest $request, string $id)
    {
       try{
        if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
        }
         $author = Author::findOrFail($id);
       $author->update($request->validated());
       return response()->json([
        "UpdetedData"=> $author 
       ]);
       }
       catch(Exception $err){
        return response()->json([
            "message"=> "Author with ". $id . " not found"
        ]);
       }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Author $author)
    {
       try{
        if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
        }
         $author->delete();
        return response()->json([
        "deletedAuthor"=> "one author deleted"
        ]);
       }
       catch(Exception $err){
        return response()->json([
            "message"=> "Author with ". $author->id . " not found"
        ]);
       }
    }
}
