

/**
 * Cart
 * @param  params  object
 * @constructor
 */
function Cart(container_e, cost_e, totalCount_e)
{
    if (arguments.length != 3) {
        throw new Error("UserError Cart(): expected 3 arguments");
    }


    this.init = function(){
        this.container_e = this.checkJqry(container_e, "container_e");
        this.cost_e = this.checkJqry(cost_e, "cost_e");
        this.totalCount_e = this.checkJqry(totalCount_e, "totalCount_e");
    };


    /**
     * Add product
     */
    this.addProduct = function(prod_count_e, add_quantity, cost, totalCount) {
        if (arguments.length != 4) {
            throw new Error("UserError Cart.addProduct(): expected 4 arguments");
        }
        var prod_count = this.checkHTML(prod_count_e, 'prod_count_e').innerText;
        /* кол-во продукта */
        prod_count_e.innerText = parseInt(prod_count) + add_quantity;
        /* сумма */
        this.cost_e.text(cost);
        /* общее кол-во */
        this.totalCount_e.text(totalCount);
    };


    /**
     * Add new product
     */
    this.addNewProduct = function(new_item_e, cost, totalCount)
    {
        if (arguments.length != 3) {
            throw new Error("UserError Cart.addNewProduct(): expected 3 arguments");
        }
        /* add and show item */
        new_item_e = this.checkJqry($(new_item_e), 'new_item_e');
        new_item_e.hide();
        this.container_e.append(new_item_e);
        new_item_e.show('fast');

        /* cost */
        this.cost_e.text(cost);
        /* total count positions */
        this.totalCount_e.text(totalCount);
    };


    /**
     * Update product
     */
    this.updateProduct = function(prod_cost_e, prod_cost, inTableTotalCount_e, cost, totalCount)
    {
        if (arguments.length != 5) {
            throw new Error("UserError Cart.updateProduct(): expected 5 arguments");
        }
        prod_cost_e.text(prod_cost);
        /* count in table */
        this.checkJqry(inTableTotalCount_e).text(parseInt(totalCount));
        /* cost */
        this.cost_e.text(cost);
        /* total count positions */
        this.totalCount_e.text(totalCount);
    };



    /**
     * Deduct product
     */
    this.deductProduct = function(item_e, prod_count_e, prod_count, cost, totalCount)
    {
        if (arguments.length != 5) {
            throw new Error("UserError Cart.addNewProduct(): expected 5 arguments");
        }
        prod_count *= 1;
        /* hide item */
        if ( prod_count < 1 ) {
            item_e.hide('fast', function(e){
                this.remove();
            });
        }
        else {
            prod_count_e.text(prod_count);
        }
        /* cost */
        this.cost_e.text(cost);
        /* total count positions */
        this.totalCount_e.text(totalCount);
    };



    /**
     * Delete product
     */
    this.deleteProduct = function(item_e, inTableTotalCount_e, cost, totalCount)
    {
        $(item_e).hide('fast', function(e){
            this.remove();
        });

        /* count in table */
        $(inTableTotalCount_e).text(parseInt(totalCount));
        /* cost */
        this.cost_e.text(cost);
        /* total count positions */
        this.totalCount_e.text(totalCount);
    };




    this.searchProductInCart = function(product_id) {
        return this.container_e[0].querySelector("[data-product_id='"+product_id+"']");
    };


    /*this.searchContainerCart = function(alias) {
        return window.querySelector("#container_cart_"+alias);
    };*/


    this.checkJqry = function(item, label)
    {
        if ( !(item instanceof jQuery) ) {
            if ( !(item instanceof HTMLElement) ) {
                throw new Error("UserError checkJqry: "+label+" parameter should be jQuery or HTMLElement object, give "+typeof item+".");
            }
            return $(item);
        }
        return item;
    };

    this.checkHTML = function(item, label)
    {
        if ( item instanceof jQuery ) {
            return item[0];
        }
        else if ( item instanceof HTMLElement ) {
            return item;
        }
        else {
            throw new Error("UserError checkHTML: "+label+" parameter should be jQuery or HTMLElement object, give "+typeof item+".");
        }
    };


    /* Init */
    this.init();


}