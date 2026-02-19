<?php

namespace App\Http\Controllers;

use App\Http\Requests\createBorrowRequest;
use App\Models\borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrow = borrowing::all();
        return response()->json([
            "return borrow"=> $borrow,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createBorrowRequest $request)
    {
        $borrow = borrowing::create($request->validated());
        return response()->json([
            "create Borrow"=> $borrow,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrow = borrowing::findOrFail($id);
        return response()->json([
            "shoing borrow"=> $borrow,
        ]);
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
