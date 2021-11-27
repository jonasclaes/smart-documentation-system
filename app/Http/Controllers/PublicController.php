<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeUpdateRequest;
use App\Models\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class PublicController extends Controller
{
    public function __construct()
    {
//        $this->middleware('signed')->only(['show']);
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

        return view('public.files.file', ['file' => $file]);
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
