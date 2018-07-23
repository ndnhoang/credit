jQuery(document).ready(function($){
    // apply credit
    $('.custom-credit button[name=apply_credit]').on('click', function(e) {
        e.preventDefault();
        var credit = $('#credit_number').val();
        credit = parseInt(credit);
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
                    $('ul.woocommerce-message, ul.woocommerce-error').remove();
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
    // checkout 
    $('form.woocommerce-checkout').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"/credit/wp-admin/admin-ajax.php",
            data:{
                'action' : 'custom_checkout',
            },
            beforeSend: function() {
                
            },
            success:function(data){
                alert(data);
            },
            error: function() {
            }
        });
    });
});