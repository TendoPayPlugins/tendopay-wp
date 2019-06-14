<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 16.04.2019
 * Time: 22:41
 */

namespace TendoPay;


use GuzzleHttp\Client;

class Example_Installments_Retriever
{
    private $product_price;
    private $client;

    public function __construct($product_price)
    {
        $this->product_price = $product_price;
        $this->client        = new Client();
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get_example_payment()
    {
        $response = $this->client->request(
            'GET',
            sprintf(Constants::get_repayment_schedule_api_endpoint_url(), $this->product_price),
            [
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-Using'      => 'TendoPay Woocommerce Plugin',
                ]
            ]
        );

        $repayment_schedule = (string)$response->getBody();
        $repayment_schedule = json_decode($repayment_schedule);

        return $repayment_schedule->installment_amount;
    }
}
