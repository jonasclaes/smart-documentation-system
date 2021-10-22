<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevisionRequest;
use Illuminate\Http\Request;

class RevisionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RevisionRequest::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $revisionRequest = RevisionRequest::create($request->all());

        return response()->json($revisionRequest, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Http\Response
     */
    public function show(RevisionRequest $revisionRequest)
    {
        return $revisionRequest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RevisionRequest $revisionRequest)
    {
        $revisionRequest->update($request->all());

        return response()->json($revisionRequest, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevisionRequest $revisionRequest)
    {
        $revisionRequest->delete();

        return response()->json(null, 204);
    }
}
