
//INFINITE SCROLL 
$('#pagination').hide();
    $('.product').jscroll({
    autoTrigger: true,
    debug: true,
    padding:0,
    nextSelector:'.page-link:last',
    contentSelector: '.product-container',
    loadingHtml: '<center><img class="preloader-products" src="/products_asset/images/gif/loader-products.gif" alt="Loading" /></center>',
    callback: function() {
        $('#pagination').remove();
    }
});