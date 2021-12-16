<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Client;

class FileController extends Controller
{
    /**
     * Setup controller.
     */
    public function __construct()
    {
        $this->authorizeResource(File::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $request->flash();

        $documentName = $request->query('documentName', '');
        $clientName = $request->query('clientName', '');

        $files = File::with('client')
            ->whereHas('client', function ($query) use ($clientName) {
                $query->where('name', 'like', "%$clientName%");
            })
            ->where('name', 'like', "%$documentName%")
            ->paginate(50);

        return view('files.files', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $latestFile = File::all()->sortBy("fileId")->last();
        $fileId = "";
        if (is_numeric($latestFile->fileId)) {
            $fileId = sprintf("%04d", intval($latestFile->fileId) + 1);
        }

        $clients = Client::all()->sortBy('name');
        return view('files.create', ['clients' => $clients, 'fileId' => $fileId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFileRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFileRequest $request)
    {
        $file = File::create($request->validated());

        return redirect()->route('files.show', ['file' => $file]);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return Renderable
     */
    public function show(File $file)
    {
        return view('files.file', ['file' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param File $file
     * @return Renderable
     */
    public function edit(File $file)
    {
        $clients = Client::all()->sortBy('name');
        return view('files.edit', ['file' => $file, 'clients' => $clients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFileRequest $request
     * @param File $file
     * @return RedirectResponse
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $file->update($request->validated());

        return redirect()->route('files.show', ['file' => $file]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @return RedirectResponse
     */
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()->route('files.index');
    }
}
