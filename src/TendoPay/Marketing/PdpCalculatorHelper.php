<?php

namespace TendoPay\Marketing;

use TendoPay\API\RepaymentCalculatorService;
use TendoPay\Exceptions\TendoPay_Integration_Exception;

class PdpCalculatorHelper
{
    private function __construct()
    {
    }

    public static function showDetails()
    {
        include TENDOPAY_BASEPATH . "/partials/product-list-item-pdp-calc.php";
    }

    /**
     * @throws TendoPay_Integration_Exception
     */
    public function claculatePrice()
    {
        $price = $_REQUEST["price"];
        $repayment_calculator = new RepaymentCalculatorService();
        $paymentDetails = $repayment_calculator->getPaymentsDetails($price);

        wp_send_json_success(
            [
                'response' => sprintf(
                    _x('Or %d payments of <span>%s</span> with ',
                        'Displayed on the product page list item. The replacement should be number of payments and'
                        . ' eprice with currency symbol',
                        'tendopay'),
                    $paymentDetails->getNumberOfPayments(),
                    wc_price($paymentDetails->getSinglePaymentAmount())
                )
            ]
        );
    }
}