<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\SendRegisterUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRegisterUserMailJob implements ShouldQueue
{
    use Queueable;

    private string $toEmail;
    private string $token;

    /**
     * Create a new job instance.
     */
    public function __construct(
        string $toEmail,
        string $token
    )
    {
        $this->toEmail = $toEmail;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->toEmail)->send(new SendRegisterUserMail($this->token));
    }
}
