<?php

namespace App\Jobs;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use App\Mail\QuoteRequestEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Redirect;

class SendQuoteRequestEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $quote;
    private $adminEmail = "fafa.capellari@gmail.com";
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->adminEmail)->send(new QuoteRequestEmail($this->quote));
    }
}
