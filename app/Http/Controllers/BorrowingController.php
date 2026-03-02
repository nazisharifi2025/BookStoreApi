<?php

namespace App\Http\Controllers;

use App\Http\Requests\createBorrowRequest;
use App\Http\Requests\updateBorrowRequest;
use App\Http\Resources\BorrowResource;
use App\Models\borrowing;
use Exception;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       try{
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
      try{
          $borrow = borrowing::create($request->validated());
          $borrow->load('books', "member_borrowing");
        return new BorrowResource($borrow);
      }
      catch(Exception $err){
        return response()->json([
            "messege"=> $err,
        ]);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       try{
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
    public function update(updateBorrowRequest $request, string $id)
    {
     try{
        $borrow = borrowing::findOrFail($id);
        $borrow->update($request->validated());
        return new BorrowResource($borrow);
     }
     catch(Exception $error){
        return response()->json([
            "message"=> $error->getMessage(),
        ]) ;
     }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
       $borrow = borrowing::findOrFail($id);
       $borrow->delete();
       return response()->json([
        "messeges"=> "this borowing deleted"
       ]);
        }catch(Exception $err){  
            return response()->json([
                "error"=> "somting went wrong"
            ]);
        }
    }
}
