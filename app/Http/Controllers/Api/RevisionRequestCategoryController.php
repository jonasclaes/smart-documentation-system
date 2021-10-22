<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevisionRequestCategory;
use Illuminate\Http\Request;

class RevisionRequestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RevisionRequestCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $revisionRequestCategory = RevisionRequestCategory::create($request->all());

        return response()->json($revisionRequestCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RevisionRequestCategory $revisionRequestCategory)
    {
        return $revisionRequestCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RevisionRequestCategory $revisionRequestCategory)
    {
        $revisionRequestCategory->update($request->all());

        return response()->json($revisionRequestCategory, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequestCategory  $revisionRequestCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevisionRequestCategory $revisionRequestCategory)
    {
        $revisionRequestCategory->delete();

        return response()->json(null, 204);
    }
}
