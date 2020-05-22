
/**
 *  Add to cart
 */

var btn_add = $('#add_button a');
var left_cart_block = $('#items_container');

/* total count element locate in main */
var total_count_el = $('#cart_total_count');
var left_cart_cost_el = $('#left_cart_cost');


/**
 * 1. Получаем по клику product_id (data-product_id)
 * 2. Ищем по селектору атрибутов в меню такой продукт (data-product_id)
 * 3. И если productInMenu != null
 *                  (Данные передаём $_POST)
 *          то передаём product_id,  html_block = true или 1 (потестировать)
 * 4. Иначе просто product_id
 * 5. Controller возвращает JSON (новый блок), кол-во товаров, сумму.
 * 6. Обновляем данные на странице.
 */

console.log('object' == typeof {});


btn_add.click( function(e) {
    e.preventDefault();
    var self = $(this);
    var href = self.attr('href');
    var product_id = self.data('product_id');
    var quantity = Number($('#add_quantity input').val());
    var product_in_cart = hasProductInCart(left_cart_block, product_id);
    var get_html = 1;

    if ( null != product_in_cart ) {
        /* set new count product in left_cart */
        var count_el = product_in_cart.querySelector('.product_count');
        count_el.innerText = Number(count_el.innerText) + quantity;
        /* not needed html block */
        get_html = '';
    }

    var data = {
        product_id: product_id,
        quantity:   quantity,
        get_html: get_html
    };

    /* send ajax */
    $.ajax({
        type: 'POST',
        url: href,
        data: $.param(data),
        success: function (response) {
            if ( null != response.html_block) {
                left_cart_block.append(response.html_block);
            }
            total_count_el.text(response.count);
            left_cart_cost_el.text(response.cost);
            console.log(response);
        }
    });
});




/**
 * Получаем елемент продукта из корзины слева
 * @param cart_block
 * @param product_id
 * @returns {Element}
 */
function hasProductInCart(cart_block, product_id)
{
    return cart_block[0].querySelector("li[data-product_id='"+product_id+"']");
}
























// function leftMenuItemInStock(all_li, product_id)
// {
//     var r = null;
//     all_li.each( function(product_id, r) {
//         return function(idx, element) {
//             if (element.getAttribute('data-product_id') == product_id) {
//                 r = idx;
//                 return r;
//             }
//         }
//     }(product_id, r));
//     console.log(r);
// }