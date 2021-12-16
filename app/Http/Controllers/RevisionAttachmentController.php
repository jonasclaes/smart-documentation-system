<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\File;
use App\Models\Revision;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;

class RevisionAttachmentController extends Controller
{
    /**
     * Setup controller.
     */
    public function __construct()
    {
        $this->authorizeResource(Document::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(File $file, Revision $revision)
    {
        $revisions = Revision::where('fileId', $file->id)->get();

        return view('revisions.attachments.create', ['file' => $file, 'revision' => $revision, 'revisions' => $revisions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     * @throws AuthorizationException
     */
    public function createDirectory(File $file, Revision $revision)
    {
        $this->authorize('create', Document::class);
        $revisions = Revision::where('fileId', $file->id)->get();

        return view('revisions.attachments.createDirectory', ['file' => $file, 'revision' => $revision, 'revisions' => $revisions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param File $file
     * @param Revision $revision
     * @return RedirectResponse
     * @throws FileNotFoundException
     */
    public function store(File $file, Revision $revision, Request $request)
    {
        if ( ! $request->hasFile('files')) {
            throw new FileNotFoundException();
        }

        $category = $request->get('category');
        $revisionId = $request->get('revisionId');
        $revision = Revision::find($revisionId);

        foreach ($request->file('files') as $inputFile) {
            if ( ! $inputFile->isValid()) {
                throw new FileNotFoundException();
            }

            $path = $inputFile->store('data/revisions/documents');

            $revision->documents()->create([
                "fileName" => $inputFile->getClientOriginalName(),
                "path" => $path,
                "size" => $inputFile->getSize(),
                "category" => $category
            ]);
        }

        return redirect()->route('revisions.show', ['file' => $file, 'revision' => $revision]);
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @return Renderable
     */
    public function show(File $file, Revision $revision, Document $document)
    {
        return view('revisions.attachments.attachment', ['file' => $file, 'revision' => $revision, 'document' => $document]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return RedirectResponse
     */
    public function destroy(File $file, Revision $revision, Document $document)
    {
        if (count($document->revisions) === 1) {
            Storage::delete($document->path);
            $document->revisions()->detach();
            $document->delete();
        } else {
            $document->revisions()->detach($revision);
        }

        return redirect()->route('revisions.show', ['file' => $file, 'revision' => $revision]);
    }


    /**
     * Download the specified resource from storage.
     *
     * @param Document $document
     */
    public function download(File $file, Revision $revision, Document $document)
    {
        $this->authorize('view', $document);
        return Storage::download($document->path, $document->fileName);
    }
}
