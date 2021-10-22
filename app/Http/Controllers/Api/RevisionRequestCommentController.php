<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevisionRequestComment;
use Illuminate\Http\Request;

class RevisionRequestCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RevisionRequestComment::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $revisionRequestComment = RevisionRequestComment::create($request->all());

        return response()->json($revisionRequestComment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Http\Response
     */
    public function show(RevisionRequestComment $revisionRequestComment)
    {
        return $revisionRequestComment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RevisionRequestComment $revisionRequestComment)
    {
        $revisionRequestComment->update($request->all());

        return response()->json($revisionRequestComment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevisionRequestComment $revisionRequestComment)
    {
        $revisionRequestComment->delete();

        return response()->json(null, 204);
    }
}
