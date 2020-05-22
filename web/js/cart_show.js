
/**
 *  Validation forms and send AJAX
 */
(function(){

    var all_forms = $('form.form-inline');


    all_forms.each(function(index, domElement){

        $(domElement).validate({

            ignore: '',
            // debug: true,

            errorElement: 'div',
            errorClass: 'invalid',

            errorPlacement: function(error, element) {
                var message_block = element.parent('div.form-group').find('div.wrap_message').children('div.message');
                error.appendTo(message_block);
                message_block.fadeIn();
            },

            showErrors: function(errorMap, errorList) {
                var self = this;
                var elements = $(this.currentElements);
                var form_groups = elements.parent('div.form-group');
                var message_blocks = form_groups.find('div.wrap_message').children('div.message');

                /* click submit */
                if ( errorList.length > 1 ) {
                    this.defaultShowErrors();
                    form_groups.addClass('has-error');
                }
                /* valid */
                else if ( $.isEmptyObject(errorMap) ) {
                    message_blocks.fadeOut(function(){
                        self.defaultShowErrors();
                    });
                    form_groups.removeClass('has-error');
                }
                /* invalid */
                else {
                    self.defaultShowErrors();
                    if (message_blocks.is(':hidden')) {
                        message_blocks.fadeIn();
                    }
                    form_groups.addClass('has-error');
                }

            },

            /*
             * Submit AJAX
             */
            submitHandler: function(form) {
                var data = {};
                var arr = $(form).serializeArray();
                /* create data object by form */
                $(arr).each(function(idx, element) {
                    /* в форме присутствуют поля с именами:
                    *   'ChangeCartPositionForm[product_id]'
                    *   'ChangeCartPositionForm[quantity]'
                    *           это требуется для валидации Yii
                    */
                    data[element.name] = element.value;
                });

                var container_e = document.getElementById('container_cart_show');
                var cost_e = container_e.querySelector('.cart-cost');
                var totalCount_e = $('.cart_total_count:visible');

                var cart = new Cart(container_e, cost_e, totalCount_e);
                var item_e = cart.searchProductInCart(data['ChangeCartPositionForm[product_id]']);
                var inTableTotalCount_e = container_e.querySelector('#inTableTotalCount');

                $.ajax({
                    type: 'post',
                    url: '/cart/' + data.action,
                    data: $.param( data ),
                    success: function(response) {
                        switch (data.action) {
                            case 'update':
                                var prod_cost_e = $(item_e).find('.product_cost');
                                cart.updateProduct(prod_cost_e, response.prod_cost, inTableTotalCount_e, response.cost, response.totalCount);
                                $(item_e).effect('highlight');
                                break;

                            case 'delete':
                                cart.deleteProduct(item_e, inTableTotalCount_e, response.cost, response.totalCount);
                                break;
                        }
                    }
                });
            },

            rules: {
                'ChangeCartPositionForm[quantity]': {
                    required: true,
                    number: true,
                    min: 1,
                    max: 100,
                },
                'ChangeCartPositionForm[product_id]': {
                    number:true,
                    min:1,
                    required:true
                }
            },

            messages: {
                'ChangeCartPositionForm[quantity]': {
                    required: 'Поле обязательно для заполнения',
                    number: 'Укажите, пожалуйста число',
                    min: 'Количество должно быть не меньше 1',
                    max: 'Количество не должно превышать 100'
                },
                'ChangeCartPositionForm[product_id]': {
                    number: 'Не установлен номер позиции',
                    min: 'Не установлен номер позиции',
                    required: 'Не установлен номер позиции',
                },
            }
        });
    });

}());

/* end validation */

