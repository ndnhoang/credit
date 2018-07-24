jQuery(document).ready(function($){
    // apply credit
    $(document).on('click', '.custom-credit button[name=apply_credit]', function(e) {
        e.preventDefault();
        $('ul.woocommerce-message, ul.woocommerce-error').remove();
        var credit = $('#credit_number').val();
        credit = parseInt(credit);
        var credit_max = $('#credit_number').attr('max');
        credit_max = parseInt(credit_max);
        if (credit > credit_max) {
            credit = credit_max;
            $('#credit_number').val(credit);
        }
        if (isNaN(credit) || credit < 0) {
            $('.woocommerce-cart-form').prepend('<ul class="woocommerce-error" role="alert"><li>Credit is invalid!</li></ul>');
        } else {
            $.ajax({
                type:'POST',
                url:"/credit/wp-admin/admin-ajax.php",
                data:{
                    'action' : 'apply_credit',
                    'credit'   : credit
                },
                beforeSend: function() {
                    
                },
                success:function(data){
                    if (data != '0') {
                        $('.cart-collaterals').html(data);    
                        $('.woocommerce-cart-form').prepend('<ul class="woocommerce-message" role="alert"><li>Add credit successfully!</li></ul>');
                    } else {
                        $('.woocommerce-cart-form').prepend('<ul class="woocommerce-error" role="alert"><li>Credit does not enough!</li></ul>');
                    }
                },
                error: function() {
                }
            });
        }
    });
});