<?php

namespace App\Mail\Public;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ShareFile extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The file instance.
     *
     * @var File
     */
    public $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Reference to file: {$this->file->name}")
            ->markdown('emails.public.share-file')
            ->with([
                'url' => URL::temporarySignedRoute('public.showFileVerifier', now()->addHours(24), ['file' => $this->file])
            ]);
    }
}
