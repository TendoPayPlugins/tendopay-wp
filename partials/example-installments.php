<?php

use TendoPay\Constants;

$product = wc_get_product();

?>
    <div class="tendopay__example-payment" style="clear: both; padding: 1rem 0;">
            <span id="tendopay_example-payment__loading" class="tendopay_example-payment__loading">
                <?php _e( 'Loading the best price for you', 'tendopay' ); ?>
                <div class="tp-loader">
                    <div class="tp-loader-dots">
                        <div class="tp-loader-dot"></div>
                        <div class="tp-loader-dot"></div>
                        <div class="tp-loader-dot"></div>
                    </div>
                </div>
            </span>
        <span id="tendopay_example-payment__received" class="tendopay_example-payment__received"></span>

        <img src="<?php echo esc_url( Constants::TENDOPAY_LOGO_BLUE ); ?>"
             class="tendopay__example-payment__logo">

        <br><a href="#"
               class="tendopay__example-payment__disclaimer"
               style="font-size: 0.8em;display: block;color: #999;"><?php _e( '*Click <u>here</u> to learn more.',
				'tendopay' ); ?></a>
    </div>
    <script>
        (function ($) {
            $.ajax('<?php echo admin_url( "admin-ajax.php?action=example-payment&price={$product->get_price()}" ); ?>')
                .done(function (data) {
                    $("#tendopay_example-payment__loading").css({display: "none"});
                    if (data && data.hasOwnProperty('data') && data.data.hasOwnProperty('response')) {
                        $("#tendopay_example-payment__received").css({display: "inline"}).html(data.data.response);
                    } else {
                        $(".tendopay__example-payment").hide();
                    }
                });

            $('body').append('<div class="tendopay__popup__container" style="display: none;"><div class="tendopay__popup__iframe-wrapper"><div class="tendopay__popup__close"></div><iframe src="http://localhost/tendopay/wp-admin/admin-ajax.php?action=popupbox" class="tendopay__popup__iframe"></iframe></div></div>');
            $('.tendopay__popup__close').click(function() {$('.tendopay__popup__container').toggle();});
            $('.tendopay__example-payment__logo, .tendopay__example-payment__disclaimer').click(function() {
                $('.tendopay__popup__container').show();
            });
        })(jQuery);
    </script>
<?php