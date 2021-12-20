<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReopenRevisionRequestRequest;
use App\Http\Requests\UpdateRevisionRequestRequest;
use App\Mail\Public\RevisionRequestReopened;
use App\Models\File;
use App\Models\Revision;
use App\Models\RevisionRequest;
use App\Models\RevisionRequestCategory;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use PHLAK\SemVer;

class RevisionRequestController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     * @throws AuthorizationException
     */
    public function show(File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('view', $revisionRequest);

        return view('revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     * @throws AuthorizationException
     */
    public function edit(File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('update', $revisionRequest);

        return view('revisionRequests.edit', ['file' => $file, 'revisionRequest' => $revisionRequest, 'categories' => RevisionRequestCategory::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return \Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateRevisionRequestRequest $request, File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('update', $revisionRequest);

        $revisionRequest->update($request->validated());

        return redirect()->route('revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Approve the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function approve(File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('update', $revisionRequest);

        $sourceRevision = $file->revisions->sortByDesc('created_at')->first();

        // Try semantic versioning, if it fails, add suffix (1) to latest revision number.
        $version = "";
        try {
            $version = SemVer\Version::parse($sourceRevision->revisionNumber)->incrementPatch();
            $version = "v{$version}";
        } catch (SemVer\Exceptions\InvalidVersionException $e) {
            $version = "{$sourceRevision->revisionNumber} (1)";
        }

        // Copy to new revision
        $newRevision = $sourceRevision->replicate();

        // Change the revision number to the new one.
        $newRevision->revisionNumber = $version;

        // Throw it into the database.
        $newRevision->push();

        // Copy all the old documents and comments over to the new revision.
        $newRevision->documents()->attach($sourceRevision->documents);
        $newRevision->comments()->attach($sourceRevision->comments);

        foreach ($revisionRequest->revisionDocuments as $revisionDocument) {
            $path = str_replace("revisionRequests", "revisions", $revisionDocument->path);
            Storage::move($revisionDocument->path, $path);

            $newRevision->documents()->create([
                "fileName" => $revisionDocument->fileName,
                "path" => $path,
                "size" => $revisionDocument->size,
                "category" => "other"
            ]);

            $revisionDocument->delete();
        }

        foreach ($revisionRequest->revisionComments as $revisionComment) {
            $newRevision->comments()->create([
                "content" => $revisionComment->content,
            ]);

            $revisionComment->delete();
        }

        $revisionRequest->delete();

        return redirect()->route('files.show', ['file' => $file]);
    }

    /**
     * Refuse the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function refuse(File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('update', $revisionRequest);

        foreach ($revisionRequest->revisionDocuments as $revisionDocument) {
            Storage::delete($revisionDocument->path);
            $revisionDocument->delete();
        }

        foreach ($revisionRequest->revisionComments as $revisionComment) {
            $revisionComment->delete();
        }

        $revisionRequest->delete();

        return redirect()->route('files.show', ['file' => $file]);
    }

    /**
     * Refuse the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return Renderable
     * @throws AuthorizationException
     */
    public function reopen(File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('update', $revisionRequest);

        return view('revisionRequests.reopen', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }

    /**
     * Refuse the specified resource.
     *
     * @param File $file
     * @param RevisionRequest $revisionRequest
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function doReopen(ReopenRevisionRequestRequest $request, File $file, RevisionRequest $revisionRequest)
    {
        $this->authorize('update', $revisionRequest);

        $input = $request->validated();

        Mail::to($revisionRequest->technicianEmail)->send(new RevisionRequestReopened($revisionRequest, $input["message"]));

        $revisionRequest->submitted = false;
        $revisionRequest->update();

        return redirect()->route('files.show', ['file' => $file]);
    }
}
