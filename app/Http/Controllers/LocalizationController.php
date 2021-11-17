<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    /**
     * Set the session locale.
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(string $locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
