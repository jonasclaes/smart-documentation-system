<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicShareFileRequest;
use App\Http\Requests\StorePublicRevisionRequestRequest;
use App\Http\Requests\StoreRevisionRequestCommentRequest;
use App\Http\Requests\ThemeUpdateRequest;
use App\Http\Requests\UpdatePublicRevisionRequestRequest;
use App\Mail\Public\RevisionRequestCreated;
use App\Mail\Public\RevisionRequestSubmitted;
use App\Mail\Public\ShareFile;
use App\Models\Document;
use App\Models\File;
use App\Models\Revision;
use App\Models\RevisionRequest;
use App\Models\RevisionRequestCategory;
use App\Models\RevisionRequestComment;
use App\Models\RevisionRequestDocument;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublicController extends Controller
{
    private function checkAccess(File $file) {
        if ( ! Session::has('fileAccess') || ! in_array($file->id, Session::get('fileAccess')) ) {
            abort(403);
        }
    }

    public function showFileVerifier(Request $request, File $file)
    {
        // Looks complicated, but it isn't.
        // Firstly, check if the request has a valid signature, if it does, great!
        // Else, it's going to check if the file ID exists in the fileAccess session key.
        // This is an array with file IDs that the user has accessed before.
        // If it doesn't exist either, throw the invalid signature exception.
        if ( ! $request->hasValidSignature() ) {
            throw new InvalidSignatureException();
        }

        // Add the file ID to the fileAccess session key.
        // If the session key doesn't exist, create it and add the file to the array.
        if ( Session::has('fileAccess') ) {
            $fileAccess = Session::get('fileAccess');
            $fileAccess[] = $file->id;
            Session::put('fileAccess', $fileAccess);
        } else {
            Session::put('fileAccess', [$file->id]);
        }

        $file->QRCode->increment('scanCount');

        return response()->redirectToRoute('public.showFile', ['file' => $file]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return Renderable
     */
    public function showFile(File $file)
    {
        $this->checkAccess($file);

        return view('public.files.file', ['file' => $file]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param Revision $revision
     * @return Renderable
     */
    public function showRevision(File $file, Revision $revision)
    {
        $this->checkAccess($file);

        return view('public.files.revision', ['file' => $file, 'revision' => $revision]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     */
    public function showRevisionRequest(File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        return view('public.files.revisionRequests.revisionRequest', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return Renderable
     */
    public function createRevisionRequest(File $file)
    {
        $this->checkAccess($file);

        return view('public.files.revisionRequests.create', ['file' => $file, 'categories' => RevisionRequestCategory::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param StorePublicRevisionRequestRequest $request
     * @param File $file
     * @return RedirectResponse
     */
    public function storeRevisionRequest(StorePublicRevisionRequestRequest $request, File $file)
    {
        $this->checkAccess($file);

        $revisionRequest = RevisionRequest::create($request->validated());

        Mail::to($revisionRequest->technicianEmail)->send(new RevisionRequestCreated($revisionRequest));

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     */
    public function editRevisionRequest(File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        return view('public.files.revisionRequests.edit', ['file' => $file, 'revisionRequest' => $revisionRequest, 'categories' => RevisionRequestCategory::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param UpdatePublicRevisionRequestRequest $request
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     */
    public function updateRevisionRequest(UpdatePublicRevisionRequestRequest $request, File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        $revisionRequest->update($request->validated());

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     */
    public function submitRevisionRequest(File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        $revisionRequest->update([
            'submitted' => true
        ]);

        Mail::to($revisionRequest->technicianEmail)->send(new RevisionRequestSubmitted($revisionRequest));

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     */
    public function addRevisionRequestAttachment(File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        return view('public.files.revisionRequests.uploadFile', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     * @throws FileNotFoundException
     */
    public function storeRevisionRequestAttachment(Request $request, File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        if ( ! $request->hasFile('files')) {
            throw new FileNotFoundException();
        }

        foreach ($request->file('files') as $inputFile) {
            if ( ! $inputFile->isValid()) {
                throw new FileNotFoundException();
            }

            $path = $inputFile->store('data/revisionRequests/documents');

            $revisionRequest->revisionDocuments()->create([
                "fileName" => $inputFile->getClientOriginalName(),
                "path" => $path,
                "size" => $inputFile->getSize()
            ]);
        }

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @param RevisionRequestDocument $revisionRequestDocument
     * @return RedirectResponse
     */
    public function destroyRevisionRequestAttachment(File $file, RevisionRequest $revisionRequest, RevisionRequestDocument $revisionRequestDocument)
    {
        $this->checkAccess($file);

        Storage::delete($revisionRequestDocument->path);
        $revisionRequestDocument->delete();

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     */
    public function addRevisionRequestComment(File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        return view('public.files.revisionRequests.createComment', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param StoreRevisionRequestCommentRequest $request
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     * @throws FileNotFoundException
     */
    public function storeRevisionRequestComment(StoreRevisionRequestCommentRequest $request, File $file, RevisionRequest $revisionRequest)
    {
        $this->checkAccess($file);

        $revisionRequest->revisionComments()->create($request->validated());

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @param RevisionRequestComment $revisionRequestComment
     * @return RedirectResponse
     */
    public function destroyRevisionRequestComment(File $file, RevisionRequest $revisionRequest, RevisionRequestComment $revisionRequestComment)
    {
        $this->checkAccess($file);

        $revisionRequestComment->delete();

        return redirect()->route('public.revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Download the specified resource from storage.
     *
     * @param File $file
     * @param Revision $revision
     * @param Document $document
     * @return StreamedResponse
     */
    public function downloadDocument(File $file, Revision $revision, Document $document)
    {
        $this->checkAccess($file);

        return Storage::download($document->path, $document->fileName);
    }

    /**
     * Send an email containing the link to the file.
     *
     * @param File $file
     */
    public function shareFile(File $file)
    {
        $this->checkAccess($file);

        return view('public.files.share-file', ['file' => $file]);
    }

    /**
     * Send an email containing the link to the file.
     *
     * @param PublicShareFileRequest $request
     * @param File $file
     */
    public function doShareFile(PublicShareFileRequest $request, File $file)
    {
        $this->checkAccess($file);

        $input = $request->validated();

        Mail::to($input['email'])->send(new ShareFile($file));

        return redirect()->route('public.showFile', ['file' => $file]);
    }

    /**
     * Display the specified resource.
     *
     * @param ThemeUpdateRequest $request
     * @return RedirectResponse
     */
    public function updateTheme(ThemeUpdateRequest $request)
    {
        $validated = $request->validated();

        session()->put('theme', $validated['theme']);

        return redirect()->back();
    }
}
