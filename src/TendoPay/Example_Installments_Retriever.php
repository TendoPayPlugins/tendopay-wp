<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 16.04.2019
 * Time: 22:41
 */

namespace TendoPay;


use TendoPay\API\RepaymentCalculatorService;

class Example_Installments_Retriever {
	/**
	 * @param $amount
	 *
	 * @return mixed
	 * @throws Exceptions\TendoPay_Integration_Exception
	 */
	public function get_example_payment( $amount ) {
		$repayment_calculator = new RepaymentCalculatorService();

        return $repayment_calculator->getPaymentsDetails( $amount );
	}
}
