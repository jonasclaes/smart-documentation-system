<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\RevisionRequest;
use App\Models\RevisionRequestDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RevisionRequestDocumentController extends Controller
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
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Http\Response
     */
    public function show(RevisionRequestDocument $revisionRequestDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(RevisionRequestDocument $revisionRequestDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RevisionRequestDocument $revisionRequestDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevisionRequestDocument $revisionRequestDocument)
    {
        //
    }

    public function download(File $file, RevisionRequest $revisionRequest, RevisionRequestDocument $revisionRequestDocument)
    {
        return Storage::download($revisionRequestDocument->path, $revisionRequestDocument->fileName);
    }
}
