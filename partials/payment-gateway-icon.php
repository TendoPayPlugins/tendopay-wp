<?php

use TendoPay\Constants;

?>
<img src="<?php echo esc_attr(Constants::TENDOPAY_LOGO); ?>"
     alt="<?php echo esc_attr__('TendoPay acceptance mark', 'tendopay'); ?>"
     class="checkout-pg-tp-logo"
     onclick="return false;"/>