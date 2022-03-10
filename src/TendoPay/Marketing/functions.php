<?php

use TendoPay\Marketing\PaymentMethodCustomizer;
use TendoPay\Marketing\PdpCalculatorHelper;

add_action('woocommerce_after_shop_loop_item_title', [PdpCalculatorHelper::class, 'showDetails'], 15);
add_action('wp_enqueue_scripts', [PdpCalculatorHelper::class, 'enqueueResources']);
add_action('wp_ajax_pdp-calculate-price', [PdpCalculatorHelper::class, 'claculatePrice']);
add_action('wp_ajax_nopriv_pdp-calculate-price', [PdpCalculatorHelper::class, 'claculatePrice']);
add_action('wp_ajax_pdp-calc-popup', [PdpCalculatorHelper::class, 'renderPopup']);
add_action('wp_ajax_nopriv_pdp-calc-popup', [PdpCalculatorHelper::class, 'renderPopup']);

add_filter('wc_get_template', [PaymentMethodCustomizer::class, 'getPaymentMethodTemplate'], 10, 3);