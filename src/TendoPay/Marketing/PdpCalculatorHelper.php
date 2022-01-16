<?php

namespace TendoPay\Marketing;

use TendoPay\API\RepaymentCalculatorService;
use TendoPay\Exceptions\TendoPay_Integration_Exception;
use TendoPay\Utils;

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
    public static function claculatePrice()
    {
        $price = $_REQUEST["price"];
        $repayment_calculator = new RepaymentCalculatorService();
        $paymentDetails = $repayment_calculator->getPaymentsDetails($price);

        wp_send_json_success(
            [
                'response' => sprintf(
                    _x('Or %d payments of <span class="tendopay__pdp-details__single-payment">%s</span> with ',
                        'Displayed on the product page list item. The replacement should be number of payments and'
                        . ' eprice with currency symbol',
                        'tendopay'),
                    $paymentDetails->getNumberOfPayments(),
                    wc_price($paymentDetails->getSinglePaymentAmount())
                )
            ]
        );
    }

    public static function enqueueResources() {
        if (!is_shop() && !is_product_category() && !is_product_tag() && !is_product_taxonomy()) {
            return;
        }

        $localized_script_handler = "tp-pdp-calc-helper";
        wp_register_script($localized_script_handler, TENDOPAY_BASEURL . "/assets/js/pdp-calc.js",
            ["jquery"], false, true);
        wp_localize_script($localized_script_handler, "urls", ["adminajax" => admin_url("admin-ajax.php")]);
        wp_enqueue_script($localized_script_handler);
    }

    public static function renderPopup() {
        ob_start();

        if (Utils::isNoInterestEnabled()) {
            include TENDOPAY_BASEPATH . "/partials/pdp-calc-popup-icons-no-interest.php";
        } else {
            include TENDOPAY_BASEPATH . "/partials/pdp-calc-popup-icons-interest.php";
        }

        $icons = ob_get_clean();

        include TENDOPAY_BASEPATH . "/partials/pdp-calc-popup.php";
        die();
    }
}