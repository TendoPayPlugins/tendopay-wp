<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 05.08.2018
 * Time: 05:59
 */

namespace TendoPay;

if (! defined('ABSPATH')) {
    die();
}

/**
 * Configuration class.
 *
 * @package TendoPay\API
 */
class Constants
{
    public const PAYMANET_FAILED_QUERY_PARAM = 'tendopay_payment_failed';

    public const HASH_ALGORITHM = 'sha256';

    public const BASE_API_URL = 'https://app.tendopay.ph';
    public const SANDBOX_BASE_API_URL = 'https://sandbox.tendopay.ph';

    public const VIEW_URI_PATTERN = 'https://app.tendopay.ph/view/transaction/%s';
    public const VERIFICATION_ENDPOINT_URI = 'payments/api/v1/verification';
    public const DESCRIPTION_ENDPOINT_URI = 'payments/api/v1/paymentDescription';
    public const BEARER_TOKEN_ENDPOINT_URI = 'oauth/token';
    public const ORDER_STATUS_TRANSITION_ENDPOINT_URL = "payments/api/v1/orderUpdate";

    public const SANDBOX_VIEW_URI_PATTERN = 'https://sandbox.tendopay.ph/view/transaction/%s';
    public const SANDBOX_VERIFICATION_ENDPOINT_URI = 'payments/api/v1/verification';
    public const SANDBOX_DESCRIPTION_ENDPOINT_URI = 'payments/api/v1/paymentDescription';
    public const SANDBOX_BEARER_TOKEN_ENDPOINT_URI = 'oauth/token';
    public const SANDBOX_ORDER_STATUS_TRANSITION_ENDPOINT_URL = "payments/api/v1/orderUpdate";

    public const TENDOPAY_ICON = 'https://static.tendopay.dev/tendopay/logo-icon-32x32.jpg';
    public const TENDOPAY_LOGO_BLUE = 'https://static.tendopay.dev/logo/tp-logo-example-payments.png';
    public const TENDOPAY_MARKETING = 'https://app.tendopay.ph/register';

    public const REPAYMENT_SCHEDULE_API_ENDPOINT_URI = "payments/api/v1/repayment-calculator?tendopay_amount=%s&payin4=%s";

    /**
     * Below constant names are used as keys of data send to or received from TP API
     */
    public const AMOUNT_PARAM = 'tp_amount';
    public const MESSAGE_PARAM = 'tp_message';
    public const AUTH_TOKEN_PARAM = 'tendopay_authorisation_token';
    public const ORDER_ID_PARAM = 'order_id';
    public const ORDER_KEY_PARAM = 'order_key';
    public const VENDOR_ID_PARAM = 'tendopay_tendo_pay_vendor_id';
    public const HASH_PARAM = 'tendopay_hash';
    public const DISPOSITION_PARAM = 'tendopay_disposition';
    public const TRANSACTION_NO_PARAM = 'tendopay_transaction_number';
    public const VERIFICATION_TOKEN_PARAM = 'tendopay_verification_token';
    public const DESC_PARAM = 'tendopay_description';
    public const STATUS_PARAM = 'tendopay_status';
    public const USER_ID_PARAM = 'tendopay_user_id';
    public const ORDER_UPDATE_PARAM = 'tendopay_order_update';
    public const REPAYMENT_CALCULATOR_INSTALLMENT_AMOUNT = 'installment_amount';
    public const REPAYMENT_CALCULATOR_TOTAL_INSTALLMENTS = 'total_installments';

    /**
     * Below constants are the keys of description object that is being sent during request to Description Endpoint
     */
    public const ITEMS_DESC_PROPNAME = 'items';
    public const META_DESC_PROPNAME = 'meta';
    public const ORDER_DESC_PROPNAME = 'order';

    /**
     * Below constants are the keys of description object's line items that are being sent during request to Description Endpoint
     */
    public const TITLE_ITEM_PROPNAME = 'title';
    public const DESC_ITEM_PROPNAME = 'description';
    public const SKU_ITEM_PROPNAME = 'SKU';
    public const PRICE_ITEM_PROPNAME = 'price';

    /**
     * Below constants are the keys of description object's meta info that is being sent during request to Description Endpoint
     */
    public const CURRENCY_META_PROPNAME = 'currency';
    public const THOUSAND_SEP_META_PROPNAME = 'thousand_separator';
    public const DECIMAL_SEP_META_PROPNAME = 'decimal_separator';
    public const VERSION_META_PROPNAME = 'version';

    /**
     * Below constants are the keys of description object's order details that are being sent during request to Description Endpoint
     */
    public const ID_ORDER_PROPNAME = 'id';
    public const SHIPPING_ORDER_PROPNAME = 'shipping';
    public const SUBTOTAL_ORDER_PROPNAME = 'subtotal';
    public const TOTAL_ORDER_PROPNAME = 'total';

    public const WP_UPLOAD_LOGGER_PATH = "/logs/";

    /**
     * Gets the hash algorithm.
     *
     * @return string hash algorithm
     */
    public static function get_hash_algorithm()
    {
        return self::HASH_ALGORITHM;
    }

    /**
     * Gets the base api URL. It checks whether to use SANDBOX URL or Production URL.
     *
     * @return string the base api url
     */
    public static function get_base_api_url()
    {
        return self::is_sandbox_enabled() ? self::SANDBOX_BASE_API_URL : self::BASE_API_URL;
    }

    /**
     * Gets the view uri pattern. It checks whether to use SANDBOX pattern or Production pattern.
     *
     * @return string view uri pattern
     */
    public static function get_view_uri_pattern()
    {
        return self::is_sandbox_enabled() ? self::SANDBOX_VIEW_URI_PATTERN : self::VIEW_URI_PATTERN;
    }

    /**
     * Gets the verification endpoint uri. It checks whether to use SANDBOX URI or Production URI.
     *
     * @return string verification endpoint uri
     */
    public static function get_verification_endpoint_uri()
    {
        return self::is_sandbox_enabled() ? self::SANDBOX_VERIFICATION_ENDPOINT_URI : self::VERIFICATION_ENDPOINT_URI;
    }

    /**
     * Gets the description endpoint uri. It checks whether to use SANDBOX URI or Production URI.
     *
     * @return string description endpoint uri
     */
    public static function get_description_endpoint_uri()
    {
        return self::is_sandbox_enabled() ? self::SANDBOX_DESCRIPTION_ENDPOINT_URI : self::DESCRIPTION_ENDPOINT_URI;
    }

    /**
     * Gets the bearer token endpoint uri. It checks whether to use SANDBOX URI or Production URI.
     *
     * @return string bearer token endpoint uri
     */
    public static function get_bearer_token_endpoint_uri()
    {
        return self::is_sandbox_enabled() ? self::SANDBOX_BEARER_TOKEN_ENDPOINT_URI : self::BEARER_TOKEN_ENDPOINT_URI;
    }

    public static function get_order_status_transition_endpoint_uri()
    {
        return self::is_sandbox_enabled() ? self::SANDBOX_ORDER_STATUS_TRANSITION_ENDPOINT_URL : self::ORDER_STATUS_TRANSITION_ENDPOINT_URL;
    }

    /**
     *
     * @return bool true if sandbox is enabled
     */
    private static function is_sandbox_enabled()
    {
        $gateway_options = get_option("woocommerce_" . Gateway_Constants::GATEWAY_ID . "_settings");

        return apply_filters(
            'tendopay_sandbox_enabled',
            $gateway_options[ Gateway_Constants::OPTION_TENDOPAY_SANDBOX_ENABLED ] === 'yes'
        );
    }
}
