<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\File;
use App\Models\Revision;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RevisionCommentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return Renderable
     */
    public function show(File $file, Revision $revision, Comment $comment)
    {
        return view('revisions.comments.comment', ['file' => $file, 'revision' => $revision, 'comment' => $comment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(File $file, Revision $revision)
    {
        $revisions = $file->revisions;

        return view('revisions.comments.create', ['file' => $file, 'revision' => $revision, 'revisions' => $revisions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param File $file
     * @param Revision $revision
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request, File $file, Revision $revision)
    {
        $input = $request->validated();

        $comment = Revision::find($input['revisionId'])->comments()->create($input);

//        $comment = $revision->comments()->create($request->validated());

        $request->session()->flash('success', 'Comment ' . $comment->id . ' for Revision ' . $revision->revisionNumber . ' was successfully created.');

        return redirect()->route('revisions.show', ['file' => $file, 'revision' => $revision]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Comment $comment
     * @return Renderable
     */
    public function edit(File $file, Revision $revision, Comment $comment)
    {
        return view('revisions.comments.edit', ['file' => $file, 'revision' => $revision, 'comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCommentRequest $request
     * @param File $file
     * @param Revision $revision
     * @return RedirectResponse
     */
    public function update(UpdateCommentRequest $request, File $file, Revision $revision, Comment $comment)
    {
        $comment->update($request->validated());

        $request->session()->flash('success', 'Comment ' . $comment->id . ' for Revision ' . $revision->revisionNumber . ' was successfully updated.');

        return redirect()->route('revisions.show', ['file' => $file, 'revision' => $revision]);
    }



    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Request $request, File $file, Revision $revision, Comment $comment)
    {
        if (count($comment->revisions) === 1) {
            $comment->revisions()->detach();
            $comment->delete();
        } else {
            $comment->revisions()->detach($revision);
        }

        $request->session()->flash('success', 'Comment ' . $comment->id . ' for Revision ' . $revision->revisionNumber . ' was successfully deleted.');

        return redirect()->route('revisions.show', ['revision' => $revision, 'file' => $file]);
    }
}
