<?php

namespace TendoPay\API;

use TendoPay\Constants;
use TendoPay\Gateway_Constants;

/**
 * Class RepaymentCalculatorEndpoint
 * @package TendoPay\API
 */
class RepaymentCalculatorService
{

    /**
     * @param $amount
     *
     * @return RepaymentDetails
     */
    public function getPaymentsDetails($amount)
    {
        $amount = (double)$amount;

        $gatewayOptions = get_option("woocommerce_" . Gateway_Constants::GATEWAY_ID . "_settings");
        $noInterestEnabled = $gatewayOptions[Gateway_Constants::OPTION_TENDOPAY_0PRC_INTEREST_ENABLED];

        $url = sprintf(Constants::BASE_API_URL . DIRECTORY_SEPARATOR . Constants::REPAYMENT_SCHEDULE_API_ENDPOINT_URI,
            $amount, $noInterestEnabled ? "true" : "false");

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($resp);

        return new RepaymentDetails($json->data->{Constants::REPAYMENT_CALCULATOR_INSTALLMENT_AMOUNT},
            $json->data->{Constants::REPAYMENT_CALCULATOR_TOTAL_INSTALLMENTS});
    }
}