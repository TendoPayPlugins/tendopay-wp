<?php

use TendoPay\Constants;

$product = wc_get_product();

?>
    <div class="tendopay__pdp-details tendopay__example-payment">
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

        <img src="<?php echo esc_url( Constants::TENDOPAY_LOGO_BLUE ); ?>" alt="TendoPay logo"
             class="tendopay__example-payment__logo">
    </div>
    <script>
        (function ($) {
            $.ajax('<?php echo admin_url( "admin-ajax.php?action=pdp-calculate-price&price={$product->get_price()}" ); ?>')
                .always(function () {
                    $("#tendopay_example-payment__loading").css({display: "none"});
                })
                .fail(function () {
                    $(".tendopay__pdp-details").hide();
                })
                .done(function (data) {
                    if (data && data.hasOwnProperty('data') && data.data.hasOwnProperty('response')) {
                        $("#tendopay_example-payment__received").css({display: "inline"}).html(data.data.response);
                    } else {
                        $(".tendopay__pdp-details").hide();
                    }
                });

            $('.tendopay__pdp-details').click(function () {
                $('.tendopay__pdp-popup__container').show();
                $('html').addClass('hide-scrollers');
            });
        })(jQuery);
    </script>
<?php
