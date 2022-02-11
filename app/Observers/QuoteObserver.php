<?php

namespace App\Observers;

use App\Jobs\SendQuoteRequestEmail;
use App\Mail\QuoteRequestEmail;
use App\Models\Quote;

class QuoteObserver
{
    /**
     * Handle the Quote "created" event.
     *
     * @param  \App\Models\Quote  $quote
     * @return void
     */
    public function created(Quote $quote)
    {
        SendQuoteRequestEmail::dispatch($quote);
    }

    /**
     * Handle the Quote "updated" event.
     *
     * @param  \App\Models\Quote  $quote
     * @return void
     */
    public function updated(Quote $quote)
    {
        //
    }

    /**
     * Handle the Quote "deleted" event.
     *
     * @param  \App\Models\Quote  $quote
     * @return void
     */
    public function deleted(Quote $quote)
    {
        //
    }

    /**
     * Handle the Quote "restored" event.
     *
     * @param  \App\Models\Quote  $quote
     * @return void
     */
    public function restored(Quote $quote)
    {
        //
    }

    /**
     * Handle the Quote "force deleted" event.
     *
     * @param  \App\Models\Quote  $quote
     * @return void
     */
    public function forceDeleted(Quote $quote)
    {
        //
    }
}
