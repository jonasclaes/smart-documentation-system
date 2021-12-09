<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\RevisionRequest;
use App\Models\RevisionRequestComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RevisionRequestCommentController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file, RevisionRequest $revisionRequest, RevisionRequestComment $revisionRequestComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file, RevisionRequest $revisionRequest, RevisionRequestComment $revisionRequestComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevisionRequestComment  $revisionRequestComment
     * @return RedirectResponse
     */
    public function destroy(File $file, RevisionRequest $revisionRequest, RevisionRequestComment $revisionRequestComment)
    {
        $this->authorize('delete', $revisionRequestComment);

        $revisionRequestComment->delete();

        return redirect()->route('revisionRequests.show', ['file' => $file, 'revisionRequest' => $revisionRequest]);
    }
}
