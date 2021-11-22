<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RevisionRequestCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RevisionRequestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return RevisionRequestCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $revisionRequestCategory = RevisionRequestCategory::create($request->all());

        return response()->json($revisionRequestCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param RevisionRequestCategory $revisionRequestCategory
     * @return Response
     */
    public function show(RevisionRequestCategory $revisionRequestCategory)
    {
        return $revisionRequestCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RevisionRequestCategory $revisionRequestCategory
     * @return Response
     */
    public function update(Request $request, RevisionRequestCategory $revisionRequestCategory)
    {
        $revisionRequestCategory->update($request->all());

        return response()->json($revisionRequestCategory, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RevisionRequestCategory $revisionRequestCategory
     * @return Response
     */
    public function destroy(RevisionRequestCategory $revisionRequestCategory)
    {
        $revisionRequestCategory->delete();

        return response()->json(null, 204);
    }
}
