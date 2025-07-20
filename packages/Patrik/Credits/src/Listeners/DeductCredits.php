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
        $order = $event->order;

        if ($order->payment->method === 'credits') {
            $customer = $order->customer;

            $customer->credit_points -= $order->grand_total;
            $customer->save();
        }
    }
}
