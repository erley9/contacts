<?php

namespace App\Listeners;

use DateTime;
use App\Events\ContactRegistered;
use App\Mail\newContactAdd;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class addEmailQueueWhenCreatedContact implements ShouldQueue
{
    public $connection = "database";

    public $queue = 'back_emails';

    public $afterCommit = true;

    public $tries = 1;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContactRegistered $event): void
    {
        $notificationEmail = env("NOTIFICATION_MAIL");

        Mail::to($notificationEmail)->send(new newContactAdd($event->contact));
    }
}
