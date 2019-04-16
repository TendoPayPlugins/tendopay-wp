<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 16.04.2019
 * Time: 22:41
 */

namespace TendoPay;


class Example_Installments_Calculator {
	const INTEREST_RATE = 0.06;
	const PAYMENT_MONTHS_FOR_AMOUNTS = [
		6000  => 3,
		10000 => 4,
		15000 => 6,
		20000 => 8,
		25000 => 10,
		INF   => 12
	];

	private $product_price;

	public function __construct( $product_price ) {
		$this->product_price = $product_price;
	}

	public function get_example_payment() {
		$payment_months = $this->get_months_for_amount();

		return floor(
			( $this->product_price * ( 1 + self::INTEREST_RATE * $payment_months ) ) / ( $payment_months * 2 )
		);
	}

	private function get_months_for_amount() {
		$amounts = array_keys( self::PAYMENT_MONTHS_FOR_AMOUNTS );
		$amounts = array_filter( $amounts, function ( $amount ) {
			return $this->product_price <= $amount;
		} );

		return self::PAYMENT_MONTHS_FOR_AMOUNTS[ min( $amounts ) ];
	}
}
