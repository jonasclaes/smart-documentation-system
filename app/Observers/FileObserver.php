<?php

namespace App\Observers;

use App\Models\File;
use App\Models\QRCode;
use Illuminate\Support\Facades\URL;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param File $file
     * @return void
     */
    public function created(File $file)
    {
        // Create a QR-code.
        QRCode::create([
            'content' => URL::signedRoute('public.showFileVerifier', ['file' => $file]),
            'fileId' => $file->id
        ]);
    }

    /**
     * Handle the File "updated" event.
     *
     * @param File $file
     * @return void
     */
    public function updated(File $file)
    {
        $file->QRCode->update([
            'content' => URL::signedRoute('public.showFileVerifier', ['file' => $file]),
        ]);
    }

    /**
     * Handle the File "deleted" event.
     *
     * @param File $file
     * @return void
     */
    public function deleted(File $file)
    {
        //
    }

    /**
     * Handle the File "restored" event.
     *
     * @param File $file
     * @return void
     */
    public function restored(File $file)
    {
        //
    }

    /**
     * Handle the File "force deleted" event.
     *
     * @param File $file
     * @return void
     */
    public function forceDeleted(File $file)
    {
        //
    }
}
