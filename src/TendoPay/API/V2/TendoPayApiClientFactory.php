<?php

namespace TendoPay\API\V2;

use TendoPay\SDK\V2\TendoPayClient;

class TendoPayApiClientFactory
{
    /**
     * @return TendoPayClient
     */
    public function createClient() {
        return new TendoPayClient([
            'CLIENT_ID'                => '955b6c16-e22c-40bf-a036-5647aec3722d',
            'CLIENT_SECRET'            => 'B1P34oJdqXMtOuVYctOMZuvNRrGqCXSYnOCdyEjg',
            'REDIRECT_URL'             => '',
            'TENDOPAY_SANDBOX_ENABLED' => true,
            'TENDOPAY_DEBUG'           => true,
        ]);
    }
}