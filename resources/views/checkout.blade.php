@extends('layouts.app') @section('shop_by_vehicle_css')
<link rel="stylesheet" href="{{ asset('css/wheels.css') }}">
@endsection @section('content')
<div class="header-content-title"></div>
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

    #produst,
    #special-product,
    footer,
    #bott,
    .container.brand-logo {
        display: none !important;
    }

    .container-fluid.home-page {
        padding: 0px 0px !important;
        background: #f1f1f1 !important;
    }
</style>
<!-- New Design End -->

@include('include.sizelinks')


<section class="shopping-cart-page">
    <div class="container">
        <div class="shopping-page title-header">
            <div id="heading" class="title">
                <h1>Checkout</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6" id="heading2">
                <h1>Order Items</h1>
            </div> 
            <div class="col-sm-6" id="heading2">
                <h1>Your Cart</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
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
                                @forelse(@$cartData as $itemKey=> $item)
                                <?php $itemData = $item['data']; ?>
                                <tr class="row{{$itemKey}}">
                                    <td class="shopping-cart-image">
                                        @if($item['producttype']=='wheel')
                                        <img src="{{ViewWheelProductImage(@$itemData->prodimage)}}" class="shop-img">
                                        @else
                                        <img src="{{ViewTireImage(@$itemData->prodimage)}}" class="shop-img">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="shop-mar">
                                           <input type="number" name="quantity[]" value="{{@$item['qty']}}" size="2" class="form-control quantity" data-key="{{$itemKey}}" min="1" max="8">
                                           <input type="hidden" name="productid[]" class="productid" value="{{$itemData->id}}">
                                           <input type="hidden" name="producttype[]"  class="producttype" value="{{@$item['producttype']}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar">
                                            <h1>{{$itemData->partno}}</h1>
                                            <h2>{{$itemData->detailtitle}}</h2>
                                            <span><a href="{{url('/removeItem/')}}/{{@$item['producttype']}}/{{@$item['productid']}}">Remove</a></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar">
                                            <h1 class="eachprice" data-price="{{$itemData->price}}">{{roundCurrency($itemData->price)}}</h1>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar">
                                            <h1 class="eachtotal">
                                                {{roundCurrency($itemData->price * @$item['qty'])}}
                                            </h1>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
            <div class="col-sm-6">
                <div class="shop-cart cart-total-section">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="shop-head">
                                    <th>Price Details</th>
                                    <th>Item Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1>Sub Total</h1>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1 class="cart-subtotal">{{roundCurrency($payment['subtotal'])}}</h1>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1>Fees</h1>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1 class="cart-fees">{{roundCurrency($payment['fees'])}}</h1>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1>Tax</h1>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1 class="cart-tax">TBD</h1>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1>Shipping</h1>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1 class="cart-shipping">TBD</h1>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1><b>Total</b></h1>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shop-mar2">
                                            <h1><b class="cart-total">{{roundCurrency($payment['total'])}}</b></h1>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="shopping-cart-page">
    <form action="{{url('/order')}}" method="POST">
        {{@csrf_field()}}
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="heading2">
                    <h1>Billing Address</h1>

                    <div class="shop-cart bill-page billing-section">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First name" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Last name" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Company Name (Optional)</label>
                                <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name" value="" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Day Phone</label>
                                <input type="tel" class="form-control" id="dayphone" name="dayphone" placeholder="Day Phone" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Cell Phone</label>
                                <input type="tel" class="form-control" id="cellphone" name="cellphone" placeholder="Cell Phone" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="zip">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="" required value="{{\Session::get('user.city')?:''}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <select class="form-control" id="state" name="state" required>
                                    <option value="">Choose...</option>
                                     @foreach(getStates('US') as $skey => $state)
                                        <option value="{{$state->name}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="" required value="{{\Session::get('user.zipcode')?:''}}" >
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6" id="heading2">
                    <h1>Shipping Address <label class="checkbox-inline"><input type="checkbox" name="same_shipping" id="same_shipping" value="yes" checked=""> Same as billing address</label> </h1>
                    <div class="shop-cart bill-page shipping-section" style="display: none;">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control required" id="shipping_firstName" name="shipping_firstname" placeholder="First name" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control required" id="shipping_lastName" name="shipping_lastname" placeholder="Last name" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Company Name (Optional)</label>
                                <input type="text" class="form-control " id="shipping_companyname" name="shipping_companyname" placeholder="Company Name" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email </label>
                                <input type="email" class="form-control required" id="shipping_email" name="shipping_email" placeholder="you@example.com" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Day Phone</label>
                                <input type="tel" class="form-control required" id="shipping_dayphone" name="shipping_dayphone" placeholder="Day Phone" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Cell Phone</label>
                                <input type="tel" class="form-control required" id="shipping_cellphone" name="shipping_cellphone" placeholder="Cell Phone" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Address</label>
                                <input type="text" class="form-control required" id="shipping_address" name="shipping_address" placeholder="1234 Main St" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="shipping_address2" name="shipping_address2" placeholder="Apartment or suite">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="zip">City</label>
                                <input type="text" class="form-control required" id="shipping_city" name="shipping_city" placeholder="" value="{{\Session::get('user.city')?:''}}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <select class="form-control required" id="shipping_state" name="shipping_state">

                                    <option value="">Choose...</option>
                                     @foreach(getStates('US') as $skey => $state)
                                        <option value="{{$state->name}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control required" id="shipping_zip" name="shipping_zip" placeholder="" value="{{\Session::get('user.zipcode')?:''}}" >
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                </div>
            </div>
        </div>
<!--         <div class="container">
            <div class="row">
                <div class="col-sm-9" id="heading2">
                    <h1>Payment Method</h1>
                </div>
                <div class="col-sm-3" id="heading2">
                    <h1></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="shop-cart bill-page">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">Payment Method</label>
                                <select class="form-control" id="country" required>
                                    <option value="">Choose...</option>
                                    <option>Visa</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Card Number</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Card Number" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">Expiration Date</label>
                                <select class="form-control" id="country" required>
                                    <option value="">Choose...</option>
                                    <option>April</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">Expiration Year</label>
                                <select class="form-control" id="state" required>
                                    <option value="">Choose...</option>
                                    <option>2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Card Verification Code</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Card Verification Code" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Bank Phone Number on Back of Card</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Bank Phone Number on Back of Card" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div> -->
        <div class="container">
<!-- <div class="chkoutContainer chkoutPayMethod">
<div class="containerTitle">Payment Method</div>
<map name="ccMap">
<area alt="Visa" title="Visa" href="javascript:pMethodIcon('Visa');" coords="3,56,72,8" shape="rect">
<area alt="MasterCard" title="MasterCard" href="javascript:pMethodIcon('MasterCard');" coords="144,8,79,56" shape="rect">
<area alt="American Express" title="American Express" href="javascript:pMethodIcon('American Express');" coords="151,8,217,56" shape="rect">
</map>
<div class="paymentIconsC">
<img src="/images/CC-NL3.png" class="reactive" align="absmiddle" usemap="#ccMap">
<a href="javascript:pMethodIcon('Affirm');"><img src="https://cdn-assets.affirm.com/images/buttons/42x205-white.svg" align="absmiddle" class="reactive"></a>
</div>
<div id="pmethodSelector" class="inputSet">
<label>Payment Method</label>
<select name="pmethod" id="pmethod" class="chkoutInput chkoutSelect">
<option value="" data-ptype=""></option>
<option value="American Express" data-ptype="CC">American Express</option>
<option value="MasterCard" data-ptype="CC">MasterCard</option>
<option value="Visa" data-ptype="CC">Visa</option>
<option value="Affirm" data-ptype="AFFIRM">Affirm Monthly Payments</option>
<option value="Authorization Code" data-ptype="AUTH">Authorization Code</option>
<option value="Tax Refund Pre Paid" data-ptype="CC">Tax Refund Pre Paid Card</option>
</select>
</div>
<div class="payMethod payCC hidden">
<div class="inputSet">
<label>Card Number</label>
<input type="text" name="ccnum" id="ccnum" class="chkoutInput integer" maxlength="16" autocomplete="cc-number">
</div>
<div class="inputSet">
<label>Expiration Date</label>
<select name="ccexpm" id="ccexpm" class="chkoutInput chkoutSelect" autocomplete="cc-exp-month">
<option value="">- Month -</option>
<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
</select><span class="ccmmyrspcr"></span><select name="ccexpy" id="ccexpy" class="chkoutInput" autocomplete="cc-exp-year">
<option value="">- Year -</option>
<option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option><option value="2029">2029</option><option value="2030">2030</option>
</select>
</div>
<div class="inputSet">
<label>Card Verification Code</label>
<input type="text" name="ccv" id="ccv" class="chkoutInput integer" maxlength="4" autocomplete="cc-csc">
</div>
<div class="inputSet">
<label>Bank Phone Number on Back of Card</label>
<input type="tel" name="bankphone" id="bankphone" class="chkoutInput" maxlength="25">
</div>
</div>
<div class="payMethod payAuth hidden">
<div class="inputSet">
<label>Authorization Code</label>
<input type="text" name="authcode" id="authcode" class="chkoutInput integer" maxlength="30" autocomplete="off">
</div>
<div class="payAuthButtons">
<span id="setAuthCode"><a onclick="if (!window.__cfRLUnblockHandlers) return false; validateAuthCode('set')" class="tsc_c3b_small tsc_c3b_grey tsc_button authCodeSet">Apply Code</a></span>
<span id="clearAuthCode" class="hidden"><a onclick="if (!window.__cfRLUnblockHandlers) return false; validateAuthCode('clear')" class="tsc_c3b_small tsc_c3b_grey tsc_button authCodeClear">Remove Code</a></span>
</div>
</div>
<div class="payMethod payAffirm hidden">
<div class="affirmPaymentInfo">
<div class="affirm-as-low-as" data-page-type="payment" data-learnmore-show="false" data-amount="672502"></div>
</div>
</div>
</div>

 -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="heading2">
                    <h1>Vehicle Information</h1>

                    <div class="shop-cart bill-page">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">Select Make</label>
                              <select required="" class="form-control browser-default custom-select CheckoutMake" name="make">
                                  <option value="">Select Make</option>
                                  @foreach(getVehicleList('make') as $key => $make)
                                  <option value="{{$make}}" {{(@\Session::get('user.searchByVehicle')['make'] == $make)?'selected':''}} >{{$make}}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="country">Select Year</label>
                                    <select required="" class="form-control browser-default custom-select CheckoutYear" name="year">
                                        <option value="">Select Year</option>
                                        @foreach(getVehicleList('year','desc') as $key => $year)
                                            <option value="{{$year}}" {{(\Session::get('user.searchByVehicle')['year'] == $year)?'selected':''}}>{{$year}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">Select Model</label>
                                    <select required="" class="form-control browser-default custom-select CheckoutModel" name="model">
                                        <option value="">Select Model</option>

                                        @foreach(getVehicleList('model') as $key => $model)
                                        <option value="{{$model}}" {{(\Session::get('user.searchByVehicle')['model'] == $model)?'selected':''}}>{{$model}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">Select Trim</label>
                                    <select required="" class="form-control browser-default custom-select CheckoutSubmodel" name="trim">
                                        <option value="">Select Trim</option>

                                        @foreach(getVehicleList('submodel') as $key => $submodel) 
                                        <option value="{{$submodel."-".$key}}" {{(\Session::get('user.searchByVehicle')['submodel'] == $submodel."-".$key)?'selected':''}}>{{$submodel."-".$key}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="country">Is Vehicle Modified?</label>
                                <select class="form-control" id="vehicle_modified" name="vehicle_modified" required>
                                    <option value="">Choose...</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country">Big Brake Kit?</label>
                                <select class="form-control" id="big_brake_kit" name="big_brake_kit" required>
                                    <option value="">Choose...</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country">Raised or Lowered?</label>
                                <select class="form-control" id="raised_lowered" name="raised_lowered" required>
                                    <option value="">Choose...</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="comment">Modified Please Explain :</label>
                                <textarea class="form-control" rows="5" id="modified_notes" name="modified_notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" id="heading2">
                    <h1>Notes</h1>

                    <div class="shop-cart bill-page">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="comment">Notes for this order :</label>
                                <textarea class="form-control" rows="15" id="notes" name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="heading2">
                    <h1>Notes</h1>
                </div>
                <div class="col-sm-6" id="heading2">
                    <h1></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 agree-check">
                    <p class="agree-para">I agree to the Terms and Conditions of the Return Policy. On Tire Orders no contact with the customer is necessary, tracking numbers will be sent to the supplied email address. On all Wheel orders we must contact all customers by phone to confirm vehicle details and verify payment method. This order will only ship out after verbal contact has been made with the customer by phone. Expect a call today or the next business day during business hours. I am aware if I am trying to use a fraudulent Credit Card I will be prosecuted to the full extent of the law. Choice of Law; Jurisdiction; Venue: You agree that your purchase of goods shall be construed in accordance with, and governed by, the laws of the State of California as applied to contracts signed, delivered, and performed solely within that State. You agree that any action or proceeding commenced as the result of claims arising from or relating to your purchase of goods shall be brought and filed in the County of Orange, State of California.</p>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-12 agree-check">
                <label class="checkbox-inline"><input type="checkbox" value="1" name="is_agree" required=""> I agree to the above Terms & Conditions</label> <br>
                    <button class="btn btn-info checkout-btn" type="submit"><i class="fa fa-shopping-cart"></i> Place Your Order</button>
                </div>
            </div>
        </div>
    </form>

    <!-- model Start -->
    <div class="modal fade " id="shipping_alert" role="dialog">
        <div class="modal-dialog wheel-view">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-left">Shipping Address Alert</h4>
                </div>
                <div class="modal-body">
                    <!-- <h2 class="modal-title"><b>Your Vehicle</b> : 2020 Acura RDX Base</h2> -->
                    <h2 class="modal-title">To Protect Our Customers, we verify all Addresses with the issuing Credit Card Companies.</h2>
                    <h2 class="modal-title">Your order <b>WILL BE DELAYED</b> and your Credit Card <b>WILL NOT</b> be charged if your <b>SHIPPING ADDRESS</b> is not registered with your Credit Card issuer.</h2> 

                    <div class="form-group has-success has-feedback text-right">
                        <button class="btn btn-info btn-close" type="button" data-dismiss="modal" style="background: #ecb23d">Continue ></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Model End  -->
</section>
@endsection
@section('custom_scripts')

<script type="text/javascript">
   $("#same_shipping").click(function(){
         if($(this).prop("checked") == true){
            $(".shipping-section").hide();
            $(".shipping-section").find('.required').attr('required',false);
         }
         else if($(this).prop("checked") == false){
            $("#shipping_alert").modal('show');
            $(".shipping-section").show();
            $(".shipping-section").find('.required').attr('required',true);
         }
   })
</script>


<script src="{{asset('/js/cart_quantity.js')}}"></script>
@endsection