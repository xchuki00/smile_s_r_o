<?php

namespace Patrik\Credits\Payment;

use Webkul\Payment\Payment\Payment;

class Credits extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'credits';

    public function getRedirectUrl()
    {
        
    }
}