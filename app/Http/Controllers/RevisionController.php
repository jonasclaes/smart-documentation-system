<?php

namespace App\Http\Controllers;

use App\Exceptions\NotImplementedException;
use App\Http\Requests\StoreRevisionRequest;
use App\Http\Requests\UpdateRevisionRequest;
use App\Models\File;
use App\Models\Revision;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws NotImplementedException
     */
    public function index()
    {
        throw new NotImplementedException();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param File $file
     * @return Renderable
     */
    public function create(File $file)
    {
        return view('revisions.create', ['files' => File::all(), 'file' => $file]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRevisionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRevisionRequest $request)
    {
        $revision = Revision::create($request->validated());

        return redirect()->route('files.show', ['file' => $revision->file]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File      $file
     * @param  \App\Models\Revision  $revision
     * @return Renderable
     */
    public function show(File $file, Revision $revision)
    {
        return view('revisions.revision', ['revision' => $revision, 'file' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File      $file
     * @param  \App\Models\Revision  $revision
     * @return Renderable
     */
    public function edit(File $file, Revision $revision)
    {
        return view('revisions.edit', ['revision' => $revision, 'file' => $file, 'files' => File::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRevisionRequest $request
     * @param  \App\Models\File      $file
     * @param  \App\Models\Revision  $revision
     * @return RedirectResponse
     */
    public function update(UpdateRevisionRequest $request, File $file, Revision $revision)
    {
        $revision->update($request->validated());

        return redirect()->route('revisions.show', ['file' => $file, 'revision' => $revision]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File      $file
     * @param  \App\Models\Revision  $revision
     * @return RedirectResponse
     */
    public function destroy(File $file, Revision $revision)
    {
        $revision->delete();

        return redirect()->route('files.show', ['file' => $file]);
    }
}
