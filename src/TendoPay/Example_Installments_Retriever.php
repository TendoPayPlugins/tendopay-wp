<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 16.04.2019
 * Time: 22:41
 */

namespace TendoPay;


use GuzzleHttp\Client;
use TendoPay\API\Repayment_Calculator_Endpoint;

class Example_Installments_Retriever {
	private $product_price;
	private $client;

	public function __construct( $product_price ) {
		$this->product_price = $product_price;
		$this->client        = new Client();
	}

	/**
	 * @param $amount
	 *
	 * @return mixed
	 * @throws Exceptions\TendoPay_Integration_Exception
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function get_example_payment( $amount ) {
		$repayment_calculator = new Repayment_Calculator_Endpoint();
		$installment_amount   = $repayment_calculator->get_installment_amount( $amount );

		return $installment_amount;
	}
}
