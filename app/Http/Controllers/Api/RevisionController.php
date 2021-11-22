<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Revision;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Revision::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $revision = Revision::create($request->all());

        return response()->json($revision, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Revision $revision
     * @return Response
     */
    public function show(Revision $revision)
    {
        return $revision;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Revision $revision
     * @return Response
     */
    public function update(Request $request, Revision $revision)
    {
        $revision->update($request->all());

        return response()->json($revision, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Revision $revision
     * @return Response
     */
    public function destroy(Revision $revision)
    {
        $revision->delete();

        return response()->json(null, 204);
    }
}
