var jqry = document.createElement('script');
jqry.src = "https://code.jquery.com/jquery-3.3.1.min.js";
document.getElementsByTagName('head')[0].appendChild(jqry);
jQuery.noConflict();

let products = [];

$('li.product').each(function(i, v) {
    var product = {
        'name': $(v).find('h2').html(),
        'value': $(v).find('.price bdi').html(),
        'image': $(v).find('.attachment-woocommerce_thumbnail').attr('data-lazy-src'),
    }
    products.push(product);
});

console.log(products);