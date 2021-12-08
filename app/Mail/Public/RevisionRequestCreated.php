<?php

namespace App\Mail\Public;

use App\Models\RevisionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RevisionRequestCreated extends Mailable
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
            ->subject('New revision request created')
            ->markdown('emails.public.revisionRequests.created', ['revisionRequest' => $this->revisionRequest]);
    }
}
