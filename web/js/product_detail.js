/**
 * Work left cart in sidebar
 */
var btn_add = $('#add_button a');
var cart_container = $('#items_container');
var totalCount_e = $('.cart_total_count:visible');   // total count element locate in main
var cost_e = $('#left_cart_cost');

/**
 * @type {Cart}
 */
var cart = new Cart(cart_container, cost_e, totalCount_e);

/**
 * Add to cart
 */
btn_add.click( function(e) {
    e.preventDefault();
    var self = $(this);

    var href = self.attr('href');
    var product_id = self.data('product_id');
    var added_quantity = parseInt($('#add_quantity input').val());
    var productInCart = cart.searchProductInCart(product_id);
    /* leftCartWidget - 'строчка Нет товаров' */
    var no_positions_e = $(document.getElementById('no_positions'));

    var data = {
        product_id: product_id,
        quantity:   added_quantity,
        get_html: (productInCart) ? '' : 1
    };

    /* send ajax */
    $.ajax({
        type: 'POST',
        url: href,
        data: $.param(data),
        success: function (response) {
            if ( null != response.html_block) {
                cart.addNewProduct(response.html_block, response.cost, response.count);
                if ( no_positions_e.is(':visible') ) { no_positions_e.hide('fast'); }
            }
            else {
                var product_count_e = productInCart.querySelector('.product_count');
                cart.addProduct(product_count_e, added_quantity, response.cost, response.count);
            }
        }
    });

});




/**
 * Deduct from cart
 */
cart_container.on('click', '.trash_product', function(e) {
    e.preventDefault();
    var self = $(this);

    var href = self.attr('href');
    var product_item_e = self.parents("li[data-product_id]");
    var product_id = product_item_e.data('product_id');
    var prod_count_e = product_item_e.find('.product_count');

    var data = {
        product_id: product_id
    };

    /* send ajax */
    $.ajax({
        type: 'POST',
        url: href,
        data: $.param(data),
        success: function (response) {
            cart.deductProduct(product_item_e, prod_count_e, response.prod_count, response.cost, response.totalCount);
        }
    });


});













