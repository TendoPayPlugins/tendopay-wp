<?php

namespace TendoPay\API;

use TendoPay\Constants;

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

        // @todo change hardcoded "true" to actual setting (interest/no interest)
        $url = sprintf(Constants::BASE_API_URL . DIRECTORY_SEPARATOR . Constants::REPAYMENT_SCHEDULE_API_ENDPOINT_URI,
            $amount, "true");

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($resp);

        return new RepaymentDetails($json->{Constants::REPAYMENT_CALCULATOR_INSTALLMENT_AMOUNT},
            $json->{Constants::REPAYMENT_CALCULATOR_TOTAL_INSTALLMENTS});
    }
}