<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\RevisionRequest;
use Illuminate\Contracts\Support\Renderable;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return Renderable
     */
    public function show(File $file, RevisionRequest $revisionRequest)
    {
        return view('revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(RevisionRequest $revisionRequest)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequest  $revisionRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevisionRequest $revisionRequest)
    {
        //
    }
}
