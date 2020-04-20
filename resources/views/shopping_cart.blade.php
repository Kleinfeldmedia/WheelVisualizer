@extends('layouts.app') @section('shop_by_vehicle_css')
<link rel="stylesheet" href="{{ asset('css/wheels.css') }}"> @endsection @section('content')

<div class="header-content-title">
</div>

<br>
<!-- New Design Start -->
<style>
    .ban-ser {
        border: 1px solid #ddd9d9 !important;
    }

    .wheel-list {
        column-width: 15em;
        padding: 10px 15px !important;
    }

    .wheel-list li a {
        color: #474646;
        display: block;
        font-size: 12px !important;
        text-align: center;
        font-family: Montserrat !important;
    }

    .wheel-list ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    .wheel-list li {
        padding: 3px;
        margin: 3px;
        margin-top: 3px;
        margin-top: 3px;
        border: 1px solid #ccc;
        box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, .05);
        background-color: #fff;
        border-radius: 2px !important;
    }

    .wheel-list ul li:first-child {
        margin-top: 0;
    }

    #heading h1 {
        font-family: Montserrat;
        color: #121214;
        font-size: 18px !important;
        text-align: center;
        font-weight: 700 !important;
    }

    .col-sm-3.payments3-card img {
        width: 100% !important;
    }

    .col-sm-3.payments-card {
        text-align: center !important;
    }

    .prod-headinghome p {
        margin: 10px 0px;
        color: #121214;
        line-height: 30px;
        font-family: poppins !important;
        font-size: 12px !important;
    }

    .col-sm-4.wheel-img {
        text-align: center !important;
    }

    /* pro Start */

    .hometabled {
        display: table;
        text-align: center;
        width: 100%;
        background: #fff;
        box-shadow: 0 2px 3px 0 rgba(180, 180, 180, .6) !important;
        border: 1px solid #d8d7d7;
        margin-bottom: 15px;
        padding: .5%;
        border-radius: 2px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
    }

    .pTopBar {
        display: table;
        width: 100%;
        padding: .5% 1%;
        margin-bottom: 1%;
        border-radius: 2px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        background: #0e1661 !important;
    }

    .pTopCell {
        display: table-cell;
        width: 50%;
        color: #fff;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .75);
        font-size: 12px;
        font-family: Montserrat !important;
    }

    .pTopCell.Phone a {
        color: #fff;
        text-decoration: none;
    }

    .asItems {
        border: 0px;
    }

    .asItems {
        padding: 0;
        padding-top: 0px;
        width: 100%;
        padding-top: 5px;
        text-align: center;
        margin: 0 auto 10px;
        background: #fff;
        border: 1px solid #cecece;
        border-radius: 2px;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        box-shadow: 0 0 3px rgba(0, 0, 0, .125);
        font-family: open sans, Arial, sans-serif;
    }

    .asItems {
        text-align: center;
        font-family: open sans, Arial, sans-serif;
    }

    .gridList {
        margin: 0 auto;
        padding: 0;
        width: auto;
        display: table;
    }

    .gridItem {
        display: inline-block;
        width: 210px;
        text-align: center;
        padding: 5px;
    }

    .homecelld b {
        color: #222 !important;
        font-size: 12px !important;
        font-family: Montserrat !important;
    }

    .hometabled {
        margin: 25px 0px !important;
    }

    .gridList.wheels.suggested .gridItem homeapge1 {
        height: 180px;
    }

    .asItems {
        border: 0px;
    }

    .prod-headinghome h2 {
        color: #0e1661 !important;
        text-align: center;
        font-family: Montserrat !important;
        font-size: 18px !important;
        font-weight: 700 !important;
    }

    .prod-headinghome b {
        color: #0e1661 !important;
        font-family: Montserrat !important;
        font-size: 12px !important;
    }

    .prod-heading-center {
        text-align: center;
    }

    .prod-headinghome h3 {
        width: 100%;
        font-size: medium;
        font-family: open sans, Arial, sans-serif;
        color: #000 !important;
        font-weight: 600 !important;
        text-align: center;
    }

    .prod-heading-center p {
        color: #0e1661 !important;
        font-size: 15px;
        line-height: 30px !important;
        font-family: Montserrat !important;
        font-weight: 700 !important;
    }

    #produst,#special-product,footer,#bott,.container.brand-logo {
        display: none !important;
    }

    .container-fluid.home-page {
        padding: 0px 0px !important;
        background: #f1f1f1 !important;
    }
</style>
<!-- New Design End -->
<div class="banner-search">
    <div class="container">
        <div class="wheel-list ban-ser">
            <ul>
                <li><a href="">17 inch Specials</a></li>
                <li><a href="">18 inch Specials</a></li>
                <li><a href="">20 inch Specials</a></li>
                <li><a href="">22 inch Specials</a></li>
                <li><a href="">24 inch Specials</a></li>
                <li><a href="">26 inch Specials</a></li>
                <li><a href="">Black Wheels</a></li>
                <li><a href="">Tuner Wheels</a></li>
                <li><a href="">3-Piece Wheels</a></li>
                <li><a href="">Off Road Wheels</a></li>
                <li><a href="">8-Lug Wheels</a></li>
                <li><a href="">Dually Wheels</a></li>
                <li><a href="">Classic Wheels</a></li>
                <li><a href="">Vehicle Gallery</a></li>
                <li><a href="">Videos</a></li>
                <li><a href="">Reviews</a></li>
                <li><a href="">Bolt Patterns</a></li>
                <li><a href="">Canada Shipping</a></li>
                <li><a href="">Feedback</a></li>
                <li><a href="">Privacy Policy</a></li>
                <li><a href="">Return Policy</a></li>
                <li><a href="">Shipping Info</a></li>
                <li><a href="">Order Status</a></li>
            </ul>
        </div>
    </div>
</div>


<section class="shopping-cart-page">
    <div class="container">
        <div class="shopping-page title-header">
            <div id="heading" class="title">
                <h1>Shopping Cart</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="shop-cart">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr class="shop-head">
                    <th></th>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Price Each</th>
                    <th>Item Total</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse(@$wheelproducts as $pkey=> $product)
                  <tr class="row{{$pkey}}">
                    <td class="shopping-cart-image"><img src="{{ViewWheelProductImage(@$product->prodimage)}}" class="shop-img"></td>
                    <td>
                      <div class="shop-mar">
                        <div class="form-group product-quantity">
                            <input type="number" name="quantity[]" value="{{@$cart['wheel'][$product->id]['qty']}}" size="2" class="form-control quantity" data-key="{{$pkey}}" min="1" max="8">
                            <input type="hidden" name="product_id[]" value="{{$product->id}}">
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="shop-mar">
                        <h1>{{$product->partno}}</h1>
                        <h2>{{$product->detailtitle}}</h2>
                        <span><a href="{{url('/removeItem/')}}/{{@$cart['wheel'][$product->id]['type']}}/{{@$cart['wheel'][$product->id]['id']}}">Remove</a></span>
                      </div>
                    </td>
                    <td><div class="shop-mar"><h1 class="eachprice" data-price="{{$product->price}}" >{{roundCurrency($product->price)}}</h1></div></td>
                    <td><div class="shop-mar"><h1 class="eachtotal">{{roundCurrency($product->price * @$cart['wheel'][$product->id]['qty'])}}</h1></div></td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4"><div class="shop-mar">Your Cart is Empty!!</h1></div></td>
                  </tr>

                  @endforelse

                  <tr>
                    <td > </td>
                    <td> </td>
                    <td> </td>
                    <td><td><div class="shop-mar">Cart Total:<h1 class="finaltotal">$0.00</h1></div></td>
                  </tr>
                 
                </tbody>
              </table>
            </div>
              <form class="form-horizontal">
                <div class="form-group has-success has-feedback text-right">
                <button class="btn btn-info cart-btn" type="button">Continue Shopping</button>
                <button class="btn btn-info cart-btn" type="button">shipping Quote</button>
                <button class="btn btn-info cart-btn" type="button">Finance Team</button>
                <button class="btn btn-info cart-btn" type="button">Paypal <sup>checkout</sup></button>
                <button class="btn btn-info checkout-btn" type="button"><i class="fa fa-shopping-cart"></i> checkout</button>
                </div>
              </form>
          </div>
        </div>
      </section>






@endsection
@section('custom_scripts')


<script type="text/javascript">
    calcualteToal();
    function calcualteToal(){
        var tot=0;
        $('.quantity').each(function(){

            var qty = $(this).val();
            var key = $(this).data('key');
            var price = $('.row'+key).find('.eachprice').data('price') * qty;
            tot =  tot+price;
        })
        text =  "$"+tot.toFixed(2);
        $('.finaltotal').text(text)
    }

    $('.quantity').change(function(){

        // var modelid = $(this).data('modelid');
        var qty = $(this).val();
        var key = $(this).data('key');
        // var productid = $(this).data('productid');
        var price = $('.row'+key).find('.eachprice').data('price') * qty;
        text =  "$"+price.toFixed(2);
        $('.row'+key).find('.eachtotal').text(text);
        calcualteToal();
        // var prodtype ='wheel';
        // var modalMsg = "Qty: "+qty+", "+$('.wheel_detail_title').text()+"     "+price+"/ea";

        // $.ajax({url: "/addToCart",data:{'qty':qty,'productid':productid,'prodtype':prodtype}, success: function(result){
        //     if(result =='success'){
        //         $(modelid).find('.modal-msg').text(modalMsg);
        //         $(modelid).modal("show");
        //     }
        //     // $(".se-pre-con").hide(); 
        // }});
    })
    $('.removeItem').click(function(){
        $.ajax({url: "/removeItem",data:{'qty':qty,'productid':productid,'prodtype':prodtype}, success: function(result){
            if(result =='success'){
                $(modelid).find('.modal-msg').text(modalMsg);
                $(modelid).modal("show");
            }
            // $(".se-pre-con").hide(); 
        }});
    });
</script>
@endsection
