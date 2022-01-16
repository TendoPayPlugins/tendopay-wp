<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 14.08.2018
 * Time: 07:26
 */

namespace TendoPay;


if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Utils class to provide utility methods used in the plugin.
 *
 * @package TendoPay
 */
class Utils {
	/**
	 * Checks whether the basic woocommerce plugin is enabled (wc is a required dependency)
	 *
	 * @return bool returns true if woocommerce is active
	 */
	public static function is_woocommerce_active() {
		return in_array( 'woocommerce/woocommerce.php',
			apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}

    public static function is_php_currency_active() {
        return get_woocommerce_currency() == 'PHP';
    }
}
