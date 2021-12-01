<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeUpdateRequest;
use App\Models\Document;
use App\Models\File;
use App\Models\Revision;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublicController extends Controller
{
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
        if ( ! Session::has('fileAccess') || ! in_array($file->id, Session::get('fileAccess')) ) {
            abort(403);
        }

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
        return view('public.files.revision', ['file' => $file, 'revision' => $revision]);
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
        return Storage::download($document->path, $document->fileName);
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
