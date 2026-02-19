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
    public function index()
    {
        $Members = member::with('borrowing')->paginate(5);
        return MembersResource::collection($Members);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMemmberRequest $request)
    {
        $Members = member::create($request->validated());
        return response()->json($Members);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $SingelMember = member::findOrFail($id);
        return response()->json([
            "singleMmber"=> $SingelMember,
        ]);
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
                "message" => "Can not update"
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
