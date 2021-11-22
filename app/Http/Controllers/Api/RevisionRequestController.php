<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevisionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RevisionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return RevisionRequest::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $revisionRequest = RevisionRequest::create($request->all());

        return response()->json($revisionRequest, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param RevisionRequest $revisionRequest
     * @return Response
     */
    public function show(RevisionRequest $revisionRequest)
    {
        return $revisionRequest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RevisionRequest $revisionRequest
     * @return Response
     */
    public function update(Request $request, RevisionRequest $revisionRequest)
    {
        $revisionRequest->update($request->all());

        return response()->json($revisionRequest, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RevisionRequest $revisionRequest
     * @return Response
     */
    public function destroy(RevisionRequest $revisionRequest)
    {
        $revisionRequest->delete();

        return response()->json(null, 204);
    }
}
