<?php

namespace App\Mail\Public;

use App\Models\RevisionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class RevisionRequestReopened extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var RevisionRequest
     */
    public RevisionRequest $revisionRequest;


    /**
     * @var string
     */
    public string $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RevisionRequest $revisionRequest, string $message)
    {
        $this->revisionRequest = $revisionRequest;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Revision request reopened")
            ->markdown('emails/public/revisionRequests/reopened', [
                'revisionRequest' => $this->revisionRequest,
                'message' => $this->message,
                'url' => URL::temporarySignedRoute('public.showFileVerifier', now()->addDays(7), ['file' => $this->revisionRequest->file])
            ]);
    }
}
