<?php

namespace App\Mail\Internal;

use App\Models\RevisionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RevisionRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var RevisionRequest
     */
    public RevisionRequest $revisionRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RevisionRequest $revisionRequest)
    {
        $this->revisionRequest = $revisionRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Revision request submitted')
            ->markdown('emails.internal.revisionRequests.submitted', ['revisionRequest' => $this->revisionRequest]);
    }
}
