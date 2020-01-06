<img src="<?php echo esc_attr( \TendoPay\Constants::TENDOPAY_ICON ); ?>"
     alt="<?php echo esc_attr__( 'TendoPay acceptance mark', 'tendopay' ); ?>"
     class="checkout-pg-tp-logo"
     onclick="return false;"/>

<a href="#"
   class="about_tendopay"
   onclick="return false;">
	<?php echo esc_attr__( 'What is TendoPay?', 'tendopay' ); ?>
</a>
<script>
    (function ($) {
        $('.checkout-pg-tp-logo,.about_tendopay').click(function () {
            $('.tendopay__popup__container').show()
        });
    })(jQuery);

</script>