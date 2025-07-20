<?php

namespace Patrik\Credits\Listeners;

class DeductCredits
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle($event)
    {
            $customer = $event->customer;

            $customer->credit_points -= $event->grand_total;
            $customer->save();
    }
}
