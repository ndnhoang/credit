jQuery(document).ready(function($){
    // home slider
    $('.home-slider .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: false,
        nav: false,
        dots: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
    // timeline story
    $('.story .timeline .item .circle').on('click', function() {
        $('.story .timeline .item').removeClass('active');
        var parent = $(this).parents('.item').first();
        var index = parent.index();
         $('.story .timeline > div .content-left').removeClass('pre-active');
        if (index > 2) {
            index -= 2;
            $('.story .timeline > div:eq(' + index + ') .content-left').addClass('pre-active');
        }
        parent.addClass('active');
    });
    // gallery product slider
    $('.carousel-gallery .owl-carousel').owlCarousel({
        items: 4,
        loop: false,
        margin: 20,
        autoplay: false,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            320: {
                margin: 10
            }
        }
    });
    // click change image 
    $('.gallery-product .carousel-gallery .item').on('click', function() {
        $('.gallery-product .carousel-gallery .item').removeClass('active');
        $(this).addClass('active');
        var image_medium = $(this).data('medium');
        var item = $(this).data('item');
        $('.gallery-product .image').attr('data-item', item);
        $('.gallery-product .image > img').fadeOut(0).attr('src', image_medium).fadeIn(500);
    });
    // gallery product zoom slider
    $('.carousel-zoom-gallery .owl-carousel').owlCarousel({
        items: 1,
        loop: false,
        margin: 0,
        autoplay: false,
        nav: true,
        navText: ['<span></span>','<span></span>'],
        dots: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
    // close gallery product zoom slider
    $('.carousel-zoom-gallery .zoom-close').on('click', function() {
        $('.carousel-zoom-gallery').css({'transform' : 'scale(0, 0)'});
    });
    // open gallery product zoom slider
    $('.gallery-product .image .zoom').on('click', function() {
        var item = $('.gallery-product .image').attr('data-item');
        item = parseInt(item);
        item -= 1;
        $('.carousel-zoom-gallery .owl-carousel').trigger('to.owl.carousel', item);
        $('.carousel-zoom-gallery').css({'transform' : 'scale(1, 1)'});
    });
    $('.carousel-zoom-gallery .owl-carousel').on('changed.owl.carousel',function(property){
        var current = property.item.index;
        var item = $(property.target).find(".owl-item").eq(current).find(".item").attr('data-item');
        $('.gallery-product .image').attr('data-item', item);
        var image_medium = $(property.target).find(".owl-item").eq(current).find(".item").attr('data-medium');
        item = parseInt(item);
        item -= 1;
        $('.carousel-gallery .owl-carousel').trigger('to.owl.carousel', item);
        $('.gallery-product .image > img').attr('src', image_medium);
    });
    // menu mobi
    $('#menu_mobi .bars').on('click', function() {
        $('.menu-mobi').addClass('open');
    });
    $('#menu_mobi .menu-close').on('click', function() {
        $('.menu-mobi').removeClass('open');
    });
    $('.menu-mobi li.menu-item-has-children').prepend('<span class="plus-menu"></span>');
    $('.menu-mobi .plus-menu').on('click', function() {
        var parent = $(this).parent();
        var sub_menu = parent.find('.sub-menu:first');
        sub_menu.slideToggle();
    });
    $('.woocommerce .loading').on('click', function(e) {
        e.preventDefault();
    });
    $('.woocommerce .read-more').on('click', function(e) {
        e.preventDefault();
        var pages = $(this).data('pages');
        var page = $(this).attr('data-page');
        page = parseInt(page);
        var cat = $(this).data('cat');
        var keyword = $(this).data('keyword');
        page += 1;
        $.ajax({
            type:'POST',            
            url:"/jayahr/wp-admin/admin-ajax.php",
            data:{
                'action' : 'load_more_product',
                'page'   : page,
                'cat'    :  cat,
                'keyword': keyword
            },
            beforeSend: function() {
                $('.read-more').hide();
                $('.loading').css('display', 'inline-block');
            },
            success:function(data){
                $('.woocommerce ul.products').append(data);
                $('.woocommerce .read-more').attr('data-page', page);
                if (pages > page) {
                    $('.read-more').css('display', 'inline-block');    
                } 
                $('.loading').hide();
            },
            error: function() {
              $('.loading').hide();  
              $('.read-more').css('display', 'inline-block');
            }
        });
    });
    // go back
    $('.go-back').on('click', function(e) {
        e.preventDefault();
        window.history.back();
    });
    // lazy load img
    $("img.lazyload").lazyload({
        effect: 'fadeIn',
        threshold : 200
    });
});