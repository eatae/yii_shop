<?php

?>
<!-- begin:article -->
<div class="row">
    <!-- begin:sidebar -->
    <div class="col-md-3 col-sm-4 sidebar">
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-title">
                        <h3>Cart</h3>
                    </div>
                    <ul class="cart list-unstyled">
                        <li>
                            <div class="row">
                                <div class="col-sm-7 col-xs-7">1 <a href="product_detail.html">Blackbox</a> <span>[ 26 ]</span></div>
                                <div class="col-sm-5 col-xs-5 text-right"><strong>$54.00</strong> <a href="#"><i class="fa fa-trash-o"></i></a></div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-sm-7 col-xs-7">1 <a href="product_detail.html">JunkShirt</a> <span>[ M ]</span></div>
                                <div class="col-sm-5 col-sm-5 text-right"><strong>$26.00</strong> <a href="#"><i class="fa fa-trash-o"></i></a></div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-unstyled total-price">
                        <li>
                            <div class="row">
                                <div class="col-sm-8 col-xs-8">Shipping</div>
                                <div class="col-sm-4 col-xs-4 text-right">$1.00</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-sm-8 col-xs-8">Total</div>
                                <div class="col-sm-4 col-xs-4 text-right">$71.00</div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6">
                                    <a class="btn btn-default" href="cart.html">Cart</a>
                                </div>
                                <div class="col-sm-6 col-xs-6 text-right">
                                    <a class="btn btn-primary" href="login.html">Checkout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- break -->
                <div class="widget">
                    <div class="widget-title">
                        <h3>Category</h3>
                    </div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#">Acessories</a></li>
                        <li><a href="#">Girl</a></li>
                        <li><a href="#">Boy</a></li>
                        <li><a href="#">Edition</a></li>
                    </ul>
                </div>
                <!-- break -->
                <div class="widget">
                    <div class="widget-title">
                        <h3>Payment Confirmation</h3>
                    </div>
                    <p>Already make a payment ? please confirm your payment by filling <a href="confirm.html">this form</a></p>
                </div>

            </div>
        </div>
    </div>
    <!-- end:sidebar -->

    <!-- begin:content -->
    <div class="col-md-9 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li id="back_breadcrumb"><a href="javascript:history.back()"><span class="glyphicon glyphicon-chevron-left"></span>назад</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="cart.html">Cart</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Account</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Payment</a></li>
                </ul>

                <h3>Your Cart</h3>
                <hr />

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
                        <td><strong>BlackBox</strong><p>Size : 26</p></td>
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
                <a href="categories.html" class="btn btn-default">Continue Shopping</a>
                <a href="login.html" class="btn btn-primary pull-right">Next</a>
            </div>
        </div>
    </div>
    <!-- end:content -->
</div>
<!-- end:article -->

