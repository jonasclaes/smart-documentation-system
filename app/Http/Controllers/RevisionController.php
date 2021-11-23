<?php

namespace App\Http\Controllers;

use App\Exceptions\NotImplementedException;
use App\Http\Requests\StoreRevisionRequest;
use App\Http\Requests\UpdateRevisionRequest;
use App\Models\Document;
use App\Models\File;
use App\Models\Revision;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @param File $file
     * @param Revision $revision
     * @return Renderable
     */
    public function show(File $file, Revision $revision)
    {
        $documents = $revision->documents;

        return view('revisions.revision', ['revision' => $revision, 'file' => $file, 'documents' => $documents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param File $file
     * @param Revision $revision
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
     * @param File $file
     * @param Revision $revision
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
     * @param File $file
     * @param Revision $revision
     * @return RedirectResponse
     */
    public function destroy(File $file, Revision $revision)
    {
        // Seems a little bit hacky, that's because
        // Laravel doesn't have a function to check
        // if it is the last relationship on a pivot
        // table.
        foreach ($revision->documents as $document) {
            // If this is the last relationship, delete the file!
            if (count($document->revisions) === 1) {
                Storage::delete($document->path);
                $revision->documents()->detach($document->id);
                $document->delete();
            }
        }

        foreach ($revision->comments as $comment) {
            // If this is the last relationship, delete the file!
            if (count($comment->revisions) === 1) {
                $revision->comments()->detach($comment->id);
                $comment->delete();
            }
        }

        $revision->documents()->detach();
        $revision->comments()->detach();

        $revision->delete();

        return redirect()->route('files.show', ['file' => $file]);
    }


    /**
     * Copy a revision.
     *
     * @param File $file
     * @return Renderable
     */
    public function copy(File $file)
    {
        $revisions = Revision::where('fileId', $file->id)->get();

        return view('revisions.copy', ['revisions' => $revisions, 'file' => $file]);
    }


    /**
     * Perform a deep copy of a revision.
     *
     * @param Request $request
     * @param File $file
     * @return RedirectResponse
     */
    public function performCopy(Request $request, File $file)
    {
        $sourceRevision = Revision::find($request->input('sourceRevisionId'));

        // Copy to new revision
        $newRevision = $sourceRevision->replicate();

        // Change the revision number to the new one.
        $newRevision->revisionNumber = $request->input('revisionNumber');

        // Throw it into the database.
        $newRevision->push();

        // Copy all the old documents and comments over to the new revision.
        $newRevision->documents()->attach($sourceRevision->documents);
        $newRevision->comments()->attach($sourceRevision->comments);

        return redirect()->route('files.show', ['file' => $file]);
    }
}
