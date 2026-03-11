<?php

namespace App\Http\Controllers;

use App\Http\Resources\BorrowResource;
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
