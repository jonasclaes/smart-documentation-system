<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\RevisionRequest;
use App\Models\RevisionRequestDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RevisionRequestDocumentController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequestDocument  $revisionRequestDocument
     * @return RedirectResponse
     */
    public function destroy(File $file, RevisionRequest $revisionRequest, RevisionRequestDocument $revisionRequestDocument)
    {
        $this->authorize('delete', $revisionRequestDocument);

        $revisionRequestDocument->delete();

        return redirect()->route('revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    public function download(File $file, RevisionRequest $revisionRequest, RevisionRequestDocument $revisionRequestDocument)
    {
        $this->authorize('view', $revisionRequestDocument);

        return Storage::download($revisionRequestDocument->path, $revisionRequestDocument->fileName);
    }
}
