<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemmberRequest;
use App\Http\Resources\MembersResource;
use App\Models\member;
use Exception;
use Illuminate\Http\Request;

class MemberV2controller extends Controller
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
         $q = member::with('activBorroing');
        if($request->has('search')){
            $search = $request->search;
            $q->where(function($query)use($search){
                $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhereHas('activBorroing', function($qu)use($search){
                    $qu->where('name', 'LIKE', "%{$search}%");
                });
            });
        }
        $Members = $q->paginate(6);
        return MembersResource::collection($Members);
       }
       catch(Exception $error){
        return $error;
       }
    }


    /**
     * Store a newly created resource in storage.
     */
   public function store(CreateMemmberRequest $request)
    {
        try{
            if(!$request->user() || !$request->user()->tokenCan('create')) {
                return response()->json([
                    "message" => "Unauthorized"
                ], 303);
        }
        $Members = member::create($request->validated());
        return response()->json($Members);
        }catch(Exception $err){
            return response()->json([
                "messege"=> "no created member",
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
          $SingelMember = member::findOrFail($id);
        return response()->json([
            "singleMmber"=> $SingelMember,
        ]);
      }
      catch(Exception $err){
        return response()->json([
            "message"=> "Member with ". $id . " not found"
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
