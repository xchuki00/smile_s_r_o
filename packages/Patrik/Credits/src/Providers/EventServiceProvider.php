<?php

namespace Patrik\Credits\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Patrik\Credits\Listeners\DeductCredits;
use Webkul\Shop\Listeners\Customer;
use Webkul\Shop\Listeners\GDPR;
use Webkul\Shop\Listeners\Invoice;
use Webkul\Shop\Listeners\Order;
use Webkul\Shop\Listeners\Refund;
use Webkul\Shop\Listeners\Shipment;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        /**
         * Sales related events.
         */
        'checkout.order.save.after' => [
            DeductCredits::class
        ],
    ];
}
