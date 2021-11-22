<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevisionRequestDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RevisionRequestDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return RevisionRequestDocument::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $revisionRequestDocument = RevisionRequestDocument::create($request->all());

        return response()->json($revisionRequestDocument, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param RevisionRequestDocument $revisionRequestDocument
     * @return Response
     */
    public function show(RevisionRequestDocument $revisionRequestDocument)
    {
        return $revisionRequestDocument;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RevisionRequestDocument $revisionRequestDocument
     * @return Response
     */
    public function update(Request $request, RevisionRequestDocument $revisionRequestDocument)
    {
        $revisionRequestDocument->update($request->all());

        return response()->json($revisionRequestDocument, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RevisionRequestDocument $revisionRequestDocument
     * @return Response
     */
    public function destroy(RevisionRequestDocument $revisionRequestDocument)
    {
        $revisionRequestDocument->delete();

        return response()->json(null, 204);
    }
}
