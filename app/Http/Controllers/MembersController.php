<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemmberRequest;
use App\Http\Requests\UpdateMemmberRequest;
use App\Http\Resources\MembersResource;
use App\Models\member;
use FFI\Exception;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       try{
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
    public function show(string $id)
    {
      try{
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
    public function update(UpdateMemmberRequest $request, string $id)
    {
        try{
            $member = member::findOrFail($id);
        $member->update($request->validated());
        return response()->json([
            "updateMember"=> $member,
        ]);
        }catch(Exception $err){
            return response()->json([
                "message" => "Member with ". $id . " can not updated somting went worng"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $member = member::findOrFail($id);
        $member->delete();
        return response()->json([
            "deleted member"=> $member,
        ]);
        }catch(Exception $err){
            return response()->json([
                "error"=> "Somting went wrong"
            ]);
        }
    }
}
