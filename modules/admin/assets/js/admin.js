/*
По клику на #ajax_orders_container tr
    переходим на страницу заказа, где отображаются:
        - данные о покупателе
        - данные о заказе
        - Order-Items заказа
*/

var ajax_container = $('div#show_orders div.col-md-12.col-sm-12.content div#ajax_orders_container');

/*
* CLick on order
*/
ajax_container.on('click', 'tr', function(e) {
    var order_id = $(this).data('order_id');
    return location.href = '/admin/order/show-order?id='+ order_id;
});