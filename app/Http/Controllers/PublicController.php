<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Contracts\Support\Renderable;

class PublicController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed')->only(['show']);
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return Renderable
     */
    public function show(File $file)
    {
        $file->QRCode->increment('scanCount');

        return view('files.file', ['file' => $file]);
    }
}
