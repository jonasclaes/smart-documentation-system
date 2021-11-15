<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Client;

class FileController extends Controller
{
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
            ->get();

        return view('files.files', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $clients = Client::all()->sortBy('name');
        return view('files.create', ['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $file = File::create($request->all());

        return redirect()->route('files.show', ['file' => $file]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return Renderable
     */
    public function show(File $file)
    {
        return view('files.file', ['file' => $file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return RedirectResponse
     */
    public function update(Request $request, File $file)
    {
        $file->update($request->all());

        return redirect()->route('files.show', ['file' => $file]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return RedirectResponse
     */
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()->route('files.index');
    }
}
