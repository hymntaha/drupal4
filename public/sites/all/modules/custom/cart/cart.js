(function ($, Drupal) {

  Drupal.behaviors.cart = {
    attach: function(context, settings) {
        $('button.fake-coupon-apply',context).bind('click',function(e){
            e.preventDefault();
            e.stopPropagation();
            var code = $('.fake-coupon-input').val();
            $('#uc-coupon-form .form-control').val(code);
            $('#uc-coupon-form').submit();
        });

        $('#cart-submit-button',context).bind('click',function(e){
            e.preventDefault();
            $('button[id^="edit-checkout"]').click();
        });

        $('.cart-update-link',context).bind('click',function(e){
            e.preventDefault();
            $('button[id^="edit-update"]').click();
        });
    }
  };

})(jQuery, Drupal);