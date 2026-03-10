<?php

namespace App\Http\Controllers;

use App\Http\Requests\createBorrowRequest;
use App\Http\Requests\updateBorrowRequest;
use App\Http\Resources\BorrowResource;
use App\Models\Book;
use App\Models\borrowing;
use Exception;
use Illuminate\Http\Request;

class BorrowingController extends Controller
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

   public function returnBook(Borrowing $borrowing){
   if($borrowing->status !== "borrowed"){
    return response()->json([
        "message"=> "This book is not currently borrowed",
    ]);
   }
   else{
     $borrowing->update([
        "returned_date"=> now(),
        "status"=> "returned",
    ]);
    $borrowing->books->returnBook();
    $borrowing->load('books', "member_borrowing");
    return new BorrowResource($borrowing);
   }
   }
   public function overdue(){
    $overdueBorrowings = borrowing::with(['books', 'member_borrowing'])
    ->where('status', 'borrowed')
    ->where('due_date', '<', now())->get();

    Borrowing::where('status', 'borrowed')
    ->where('due_date', '<', now())
    ->update(['status' => 'overdue']);
    return BorrowResource::collection($overdueBorrowings);
   }
}
