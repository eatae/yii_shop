<?php

?>
<!-- Дизайн создан -->
<!-- Перед добавлением foreach -->


<!-- begin:article -->
<div class="row" id="cart_show">

    <!-- begin:content -->
    <div class="col-md-12 col-sm-12 content">

        <div class="row" id="cart_nav">
            <div class="col-md-7">
                <h3>Корзина</h3>
            </div>
            <div class="col-md-5">
                <ul class="nav nav-pills pull-right">
                    <li class="active"><a href="cart.html">Cart</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Account</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Payment</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><img src="img/product1.jpg" class="img-cart" /></td>
                        <td><strong>BlackBoxBlackBoxBlackBoxBlackBox</strong><p>Size : 26</p></td>
                        <td>
                            <form class="form-inline">
                                <input class="form-control" type="text" value="1" />
                                <button rel="tooltip" title="Update" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                <a href="#" class="btn btn-primary" rel="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
                            </form>
                        </td>
                        <td>$54.00</td>
                        <td>$54.00</td>
                    </tr>
                    <tr>
                        <td><img src="img/product2.jpg" class="img-cart" /></td>
                        <td><strong>JunkShirt</strong><p>Size : M</p></td>
                        <td>
                            <form class="form-inline">
                                <input class="form-control" type="text" value="2" />
                                <button rel="tooltip" title="Update" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                <a href="#" class="btn btn-primary" rel="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
                            </form>
                        </td>
                        <td>$16.00</td>
                        <td>$32.00</td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Total Product</td>
                        <td>$86.00</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Total Shipping</td>
                        <td>$2.00</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td>$88.00</td>
                    </tr>
                    </tbody>
                </table>
                <a href="categories.html" class="btn btn-default">Продолжить покупки</a>
                <a href="login.html" class="btn btn-primary pull-right">Далее</a>
            </div>
        </div>
    </div>
    <!-- end:content -->
</div>
<!-- end:article -->