<?php
/**
 * Created by PhpStorm.
 * User: robert.klodzinski
 * Date: 03.01.2020
 * Time: 16:16
 */

namespace TendoPay;


class Gateway_Constants {
	/**
	 * Unique ID of the gateway.
	 */
	const GATEWAY_ID = 'tendopay';

	const TENDOPAY_PAYMENT_INITIATED_KEY = '_tendopay_payment_initiated';

	const OPTION_METHOD_TITLE = 'method_title';
	const OPTION_ENABLED = 'enabled';
	const OPTION_METHOD_DESC = 'method_description';
	const OPTION_TENDOPAY_SANDBOX_ENABLED = 'tendo_sandbox_enabled';
	const OPTION_TENDOPAY_VENDOR_ID = 'tendo_pay_merchant_id';
	const OPTION_TENDOPAY_SECRET = 'tendo_secret';
	const OPTION_TENDOPAY_CLIENT_ID = 'tendo_client_id';
	const OPTION_TENDOPAY_CLIENT_SECRET = 'tendo_client_secret';
	const OPTION_TENDOPAY_EXAMPLE_INSTALLMENTS_LOCATION = 'tendo_example_installments_location';
	const OPTION_TENDOPAY_EXAMPLE_INSTALLMENTS_DEFAULT_LOCATION = 'woocommerce_after_add_to_cart_button';
}