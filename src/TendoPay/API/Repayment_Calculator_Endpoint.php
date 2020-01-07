<?php

namespace TendoPay\API;

use TendoPay\Constants;
use TendoPay\Exceptions\TendoPay_Integration_Exception;
use TendoPay\Gateway_Constants;

/**
 * Class Repayment_Calculator_Endpoint
 * @package TendoPay\API
 */
class Repayment_Calculator_Endpoint {

	/**
	 * @param $amount
	 *
	 * @throws TendoPay_Integration_Exception
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function get_installment_amount( $amount ) {
		$amount = (double) $amount;

		$gateway_options = get_option( "woocommerce_" . Gateway_Constants::GATEWAY_ID . "_settings" );
		$hash_calc       = new Hash_Calculator( $gateway_options[ Gateway_Constants::OPTION_TENDOPAY_SECRET ] );

		$hash = $hash_calc->calculate( [ $amount ] );

		$url = sprintf( Constants::REPAYMENT_SCHEDULE_API_ENDPOINT_URI, $amount );

		$endpoint_caller = new Endpoint_Caller();
		$response        = $endpoint_caller->get_client()->request( 'GET', $url, [
			"headers" => $endpoint_caller->get_default_headers()
		] );

		$response = apply_filters( 'tendopay_repayment_calculator_response', $response );

		if ( $response->getStatusCode() !== 200 ) {
			throw new TendoPay_Integration_Exception(
				__( 'Got response code != 200 while requesting for payment calculation', 'tendopay' ) );
		}

		$json = json_decode( (string) $response->getBody() );

		return $json->data->{Constants::REPAYMENT_CALCULATOR_INSTALLMENT_AMOUNT};
	}
}