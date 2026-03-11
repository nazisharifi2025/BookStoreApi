<?php

namespace App\Http\Controllers;

use App\Http\Requests\createBorrowRequest;
use App\Http\Resources\BorrowResource;
use App\Models\Book;
use App\Models\borrowing;
use Exception;
use Illuminate\Http\Request;

class BorroingV2controller extends Controller
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
         $borrow = borrowing::with(['books', 'member_borrowing']);
         $borrow->load('books', "member_borrowing");
        return BorrowResource::collection($borrow);
       }
       catch(Exception $error){
        return $error ;
       }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createBorrowRequest $request)
    {
       try {
        if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
        }
        $borrow = borrowing::create($request->validated());
        $borrow->load('books', "member_borrowing");

        $bookId = $borrow->books->id;
        $book = Book::findOrFail($bookId);

          $book->barrow();

        return new BorrowResource($borrow);
    } catch (Exception $err) {
        return response()->json([
            "messege" => $err->getMessage(),
        ]);
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
         $borrow = borrowing::findOrFail($id);
         $borrow->load('books', "member_borrowing");
        return response()->json([
            "shoing borrow"=> $borrow,
        ]);
       }
       catch(Exception $err){
        return response()->json([
            "messege"=> $err->getMessage(),
        ]);
       }
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
