@extends('layouts.app') @section('shop_by_vehicle_css')
<link rel="stylesheet" href="{{ asset('css/wheels.css') }}"> 

<link rel="stylesheet" href="{{ asset('css/rating.css') }}">
@endsection 


@section('metakeywords')
<meta name="description" content="{{@$tire->metadesc}}">
<meta name="description" content="{{@$tire->prodmetadesc}}">
@endsection 


@section('content')

<style>
    .hometabled {
        margin: 25px 0px !important;
    }

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
        background:#0e1661 !important;
    }

    .pTopCell {
        display: table-cell;
        width: 50%;
        color: #fff;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .75);
        font-weight:100;
        font-size: 12px;
        font-family: Montserrat !important;
    }

    .pTopCell.Phone a {
        color: #fff;
        text-decoration: none;
        font-size: 12px;
    }

    .product-details table.product-info {
        margin: 15px 0;
    }

    .product-name
    {
        font-size: 12px !important;
        font-family: Montserrat !important;
        text-align: left;
        font-weight: 700 !important;
        margin:10px 0px !important;
    }
    .product-name2
    {
      font-size: 14px !important;
      font-family: Montserrat !important;
      text-align: left;
      font-weight: 700 !important;
      margin-top:10px !important;
      margin-bottom:20px !important;
    }

    .product-info td {
        color: #222 !important;
        text-align: left;
        width: 200px !important;
        padding: 5px 0px !important;
        font-family:Poppins !important;
        font-size: 12px;
    }
    .product-info td a
    {
        color: #222 !important;
    }
    .product-details .rating {
        display: table;
    }

    #button-cart {
        float: right;
        padding: 0px 20px !important;
        margin: 0px 7px !important;
        font-size: 12px !important;
    }

    .rating .product-rating {
        border-right: 1px solid #eaeaea;
        float: left;
        margin: 0 10px 0 0 !important;
        padding: 2px 10px 0 0;
        height: 20px;
    }

    .tire-price {
        border-top: 1px solid #eaeaea;
        border-bottom: 1px solid #eaeaea;
        padding: 15px 0;
        margin: 15px 0 20px;
        text-align: left;
    }

    .tire-price .price-new {
        float: left;
        margin: 0 8px 0 0;
    }

    .fa.fa-star.off.fa-stack-1x {
        color: #222 !important;
    }

    .product-options .product-quantity {
        clear: both;
        float: left;
        margin: 0;
    }

    .product-details #button-cart {
        background: #fed700;
        border-color: #fed700;
        color: #000000;
        float: left;
        font-family: "poppins", Helvetica, sans-serif;
        font-size: 14px;
        letter-spacing: 1px;
        line-height: 26px;
        padding: 7px 15px 6px 48px;
        position: relative;
        text-transform: capitalize;
    }

    .product-quantity #input-quantity {
        border: 1px solid #eaeaea;
        font-size: 14px;
        float: left;
        height: 35px;
        line-height: 27px;
        padding: 0 6px;
        text-align: center;
        width: 50px;
    }

    #button-cart {
        height: 43px !important;
    }

    .rating {
        padding: 10px 0px !important;
    }

    #demo-des {
        padding: 40px 0px !important;
    }

    #table-section {
        padding: 40px 0px !important;
        background: #f5f5f5;
    }

    .with-nav-tabs.panel-default .nav-tabs>li>a,
    .with-nav-tabs.panel-default .nav-tabs>li>a:hover,
    .with-nav-tabs.panel-default .nav-tabs>li>a:focus {
        color: #777;
    }

    .with-nav-tabs.panel-default .nav-tabs>.open>a,
    .with-nav-tabs.panel-default .nav-tabs>.open>a:hover,
    .with-nav-tabs.panel-default .nav-tabs>.open>a:focus,
    .with-nav-tabs.panel-default .nav-tabs>li>a:hover,
    .with-nav-tabs.panel-default .nav-tabs>li>a:focus {
        color: #777;
        background-color: #ddd;
        border-color: transparent;
    }

    .with-nav-tabs.panel-default .nav-tabs>li.active>a,
    .with-nav-tabs.panel-default .nav-tabs>li.active>a:hover,
    .with-nav-tabs.panel-default .nav-tabs>li.active>a:focus {
        color: #555;
        background-color: #fff;
        border-color: #ddd;
        border-bottom-color: transparent;
    }

    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu {
        background-color: #f5f5f5;
        border-color: #ddd;
    }

    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>li>a {
        color: #777;
    }

    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>li>a:hover,
    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>li>a:focus {
        background-color: #ddd;
    }

    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>.active>a,
    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>.active>a:hover,
    .with-nav-tabs.panel-default .nav-tabs>li.dropdown .dropdown-menu>.active>a:focus {
        color: #fff;
        background-color: #555;
    }

    .tab-content.wheel-list-tab {
        margin-bottom: 0px !important;
    }

    .tab-content.wheel-list-tab .browser-default.custom-select {
        margin: 0px 30px !important;
        padding: 4px 40px !important;
    }

    .btn.vehicle-button {
        background: #000 !important;
        border-radius: 5px !important;
        color: #fff !important;
        font-size: 12px !important;
    }

    .font {
        padding: 0px 5px !important;
        color: #000 !important;
        margin: 0px 0px !important;
    }

    #tab5default .form-inline.mr-auto .form-control {
        margin: 0px 30px !important;
        padding: 4px 40px !important;
        border: 1px solid #7a7a7a !important;
    }
    #demo-des {
        background: #f5f5f5 !important;
    }

    .prod-headinghome p
    {
        margin: 10px 0px;
        color:#121214;
        font-size: 12px !important;
        line-height: 30px !important;
        font-family: Poppins !important;
    }
    .prod-headinghome h1
    {
        font-family: Montserrat !important;
        font-size: 15px !important;
        font-weight: 100 !important;
        color:#0e1661 !important;
    }

    .general_info .price-section {
        margin: 0 0 5px;
        padding-bottom: 10px;
    }

    .price-section span.price-new {
        font-size: 31px;
        color: #fd5503;
    }

    .price-section span.price-old {
        text-decoration: line-through;
        margin: 0 10px 0 0;
    }
    .rating a {
        color: #0e1661;
    }
    .price-old {
        color: #ecb23d;
        font-size: 16px;
        line-height: 20px;
        text-decoration: line-through;
    }
    .price-save {
        color: green;
        font-size: 16px;
        line-height: 20px;
        /*text-decoration: line-through;*/
    }
    .price-section {
        text-align: left !important;
    }

    .form-group.product-quantity {
        padding: 10px 0px !important;
    }

    .product-info {
        margin: 0px 0px !important;
    }

    #table-section thead {
        background: #0e1661 !important;
        color: #fff !important;
        font-size: 12px !important;
        font-weight: 100 !important;
        font-family: Montserrat !important;
    }

    .table.table-section {
        margin-bottom: 0px !important;
    }

    .table.table-section th {
        font-weight: 100 !important;
    }

    .btn.btn-default.cart-1 {
        border-radius: 0% !important;
        color: #fff !important;
        background: blue;
        font-size: 10px !important;
        font-family:Montserrat !important;
        border:none !important;
    }

    .btn.btn-default.cart-2 {
        border-radius: 0% !important;
        color: #fff !important;
        background: green;
        font-size: 10px !important;
        font-family:Montserrat !important;
    }

    .table.table-section th {
        text-align: center !important;
    }

    .table.table-section td {
        text-align: center !important;
        color: #000 !important;
        font-size: 12px !important;
        transition: 1s all;
        font-family: Poppins !important;
    }

    .table.table-section td:hover {
        text-decoration: underline;
        transition: 1s all;
        color: blue !important;
        cursor: pointer;
    }

    .table>tbody>tr>td {
        border: 1px solid #ddd;
    }

    .btn.btn-default.cart-1:hover,
    .btn.btn-default.cart-2:hover {
        text-decoration: underline;
    }

    .tire-des h1,.tire-des h2 {
        font-size: 12px !important;
        margin: 0px;
        line-height: 30px;
        font-family:Montserrat !important;
    }

    .prograss-bar-head
    {
        font-size: 10px;
        text-align: left;
        padding: 2px 0px !important;
        color: #0e1661 !important;
        margin: 0px 0px !important;
        font-family:Poppins !important;
    }

    .progress.pro-bar {
        margin-bottom: 5px !important;
        height: 15px !important;
    }

    .col-sm-6.tire-details img {
        width: 100% !important;
        height: 300px;
    }

    .progress.pro-bar .progress-bar {
        font-size: 10px;
        line-height: 15px;
    }

    .benifit img {
        width: 100%;
    }

    .benifit-head
    {
        font-size: 12px !important;
        font-weight: 100 !important;
        margin: 0px 0px !important;
        padding: 2px 0px;
        text-align: left;
        font-family: Montserrat !important;
    }

    .row.tire-benifit {
        padding: 5px 0px !important;
    }

    .benifit-title p {
        font-size: 10px !important;
        text-align: left;
        color:#000 !important;
        line-height: 25px !important;
        margin: 0px 0px;
        font-family: Poppins !important;
    }

    .video img {
        width: 100% !important;
    }

    .instock-head a
    {
        color:#ecb23d !important;
        font-family: Montserrat !important;
        font-size: 12px !important;
        font-weight: 700;
    }
    .instock
    {
        padding:15px 0px !important;
    }
    .youtube-video {
        margin: 20px 0px !important;
    }

    .instock-head {
        font-size: 12px !important;
        text-align: left;
        padding: 0px 0px !important;
        margin: 0px 0px !important;
        font-family: Poppins !important;
    }

    .video img {
        width: 100% !important;
    }

    .btn.btn-info
    {
        background: #ecb23d !important;
        font-family:Montserrat !important;
        font-size:12px !important;
    }

    .btn.btn-info:hover {
        background: #0e1661 !important;
    }

    .reward-block {
        padding: 10px 0px !important;
    }
    .reward-block .btn
    {
        width:100% !important;
    }
    .modal-dialog.tire-view {
        width: 300px !important;
    }

    .form-group.has-success.has-feedback {
        margin: 0px 0px !important;
    }

    .modal-dialog.tire-view.btn.btn-info {
        margin: 10px 0px !important;
    }

    .form-group.has-success.has-feedback {
        margin: 10px 0px !important;
    }
    .col-sm-5.control-label
    {
        color: #000 !important;
        font-family: Montserrat !important;
        font-size: 12px !important;
    }
    .modal-dialog.tire-view .modal-header
    {
        padding: 10px !important;
        border-bottom:none;
    }
    .animated {
        animation-duration: 2.5s;
        animation-fill-mode: both;
        animation-iteration-count: infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .pulse {
        animation-name: pulse;
        animation-duration: 1s;
    }
</style>
<style>
    .price-section h1 {
        font-size: 12px !important;
        padding: 5px 0px !important;
        margin: 0px 0px !important;
        line-height: 30px;
    }
    .padd
    {
        padding:0px 0px !important;
    }
    .price-section h2 {
        font-size: 12px !important;
        padding: 5px 0px !important;
        margin: 0px 0px !important;
        line-height: 30px;
    }
    .modal-dialog.tire-view .modal-header {
        background: #0e1661 !important;
    }

    modal-dialog.tire-view h4 {
        font-weight: 700;
        color: #fff;
        font-size: 12px !important;
    }

    .progress-title {
        font-size: 10px;
        color: #000 !important;
        margin: 5px 0px !important;
        text-align: left !important;
    }

    .progress {
        height: 10px;
        background: #cbcbcb;
        border-radius: 0;
        box-shadow: none;
        margin-bottom: 0px;
        overflow: visible;
    }

    .progress .progress-bar {
        box-shadow: none;
        position: relative;
        -webkit-animation: animate-positive 2s;
        animation: animate-positive 2s;
    }

    .progress .progress-value {
        font-size: 12px;
        color: #000;
        position: absolute;
        top: 10px;
        right: 0;
    }

    @-webkit-keyframes animate-positive {
        0% {
            width: 0;
        }
    }

    @keyframes animate-positive {
        0% {
            width: 0;
        }
    }
</style> 

<link rel="stylesheet" href="{{ asset('css/preview-image.css') }}">

<section id="tires-des">


    <!-- Cart Start -->
    <div class="container">
              @if(@$vehicle || count(Request::all()) > 0)
              <div class="wheel-list-change-tab">
                  <div class="row">
                      <div class="col-md-8 left-head">
                        <p>
                            @if(@$vehicle)
                            Your Selected Vehicle:
                                <b>{{@$vehicle->year}} {{@$vehicle->make}} {{@$vehicle->model}} {{@$vehicle->submodel}}</b>
                            OEM Tire Size:
                                <b>{{@$vehicle->ChassisModels->tire_size}}</b>

                            <br>
                            @endif
                        </p>
                      </div>
                      <div class="col-md-4 right-button"><button type="submit" class="btn vehicle-change"><a href="{{url('/tirelist')}}">Change</a></button></div>
                  </div>
              </div>
              @endif
        <div class="hometabled">
            <div class="pTopBar">
                <div class="pTopCell HotDeals">Hot Deals Save 30%-75%</div>
                <div class="pTopCell Phone"><a href="tel:1-800-901-6003" title="Telephone 1-800-901-6003">1-800-901-6003</a></div>
            </div>
            <!-- The PreviewModal -->
            <div id="preview-modal" class="preview-modal">
              <span class="preview-close">&times;</span>
              <img class="preview-modal-content" id="preview-modal-img">
              <div id="preview-caption"></div>
            </div>

            <div class="row">
              <?php $divClass=2;$benefits=false;$ratings=false;?>
              @if(@$tire->benefits1 || @$tire->benefits2 || @$tire->benefits3 || @$tire->benefits4)
                <?php $divClass+=1;$benefits=true;?>
              @endif
              @if(@$tire->dry_performance > 0 ||@$tire->wet_performance > 0 ||@$tire->mileage_performance > 0 ||@$tire->ride_comfort > 0 ||@$tire->quiet_ride > 0 ||@$tire->winter_performance > 0 ||@$tire->fuel_efficiency > 0 || @$tire->braking > 0 || @$tire->responsiveness > 0 || @$tire->sport > 0 || @$tire->handling > 0 || @$tire->off_road > 0 )
                <?php $divClass+=1;$ratings=true;?>
              @endif
                <div class="col-sm-{{12/$divClass}} tire-img">

                    <div class="tire-des">
                        <div href="{{ViewTireImage(@$tire->prodimage)}}" class="zoomple">
                        <img id="preview-image" class="wheelImageNew" src="{{ViewTireImage(@$tire->prodimage)}}">
                        </div>
                        <h1>Price for TIRE ONLY</h1>
                        <h2>Rim depicted in image NOT INCLUDED</h2>
                    </div>

                    @if(ViewTireBadgeImage(@$tire->badge1))
                    <img src="{{ViewTireBadgeImage(@$tire->badge1)}}" width="70px" height="70px">
                    @endif
                    @if(ViewTireBadgeImage(@$tire->badge2))
                    <img src="{{ViewTireBadgeImage(@$tire->badge2)}}" width="70px" height="70px">
                    @endif
                    @if(ViewTireBadgeImage(@$tire->badge3))
                    <img src="{{ViewTireBadgeImage(@$tire->badge3)}}" width="70px" height="70px">
                    @endif
                </div>
                <div class="col-sm-{{12/$divClass}} shop-details">
                    <h1 class="product-name tire-detail-title">{{@$tire->detailtitle}}</h1>
                    <div class="rating-section product-rating-status text-left">
                        <div class="rating">
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span> &nbsp;&nbsp;
                            <a href="">0 reviews</a> / <a>Write a review</a>
                        </div>
                    </div>

                    <table class="product-info">
                        <tbody>
                            <tr>
                                <td><h1 class="product-name"><!-- Brand :--> {{@$tire->prodbrand}}</h1></td>
                                <td><h1 class="product-name"><!-- Model :--> {{@$tire->prodmodel}}</h1></td>
                            </tr>
                            <tr>
                                <td class="product-info-value"><a href="">Size : {{@$tire->tiresize?:' - '}}</a></td>
                                <td class="product-info-value">UTQG : {{@$tire->utqg?:' - '}}</td>
                            </tr>
                            <tr>
                                <td class="product-info-value">Speed Rating : {{@$tire->speedrating?:' - '}}</td>
                                <td class="product-info-value">Load Index : {{@$tire->loadindex?:' - '}}</td>
                            </tr>
                        <!-- New Table Start -->
                            <tr>
                                <td class="product-info-value">Part No : {{@$tire->partno?:' - '}}</td>
                                <td class="product-info-value">Warranty : {{@$tire->warranty?:' - '}}</td>
                            </tr>
                            <tr>
                                <td>Original Price : <span class="price-old">{{roundCurrency($tire->originalprice)}}</span></td>
                                <td class="product-info-value">You Save : <span class="price-save">{{roundCurrency($tire->yousave)}}</td>
                            </tr>
                            <tr>
                                <td>Set of 4 : <span class="price-new2">{{roundCurrency(@$tire->set_amount)}}</span></td>
                                <td class="product-info-value">Your Price : <span class="price-new2">{{roundCurrency(@$tire->price)}}</span></td>
                            </tr>
                            <tr>
                                <td><div class="reward-block">
                                    @if(@$tire->saletype == 4)
                                    <button class="btn btn-info" type="button">See Price in Cart</button>
                                    @elseif(@$tire->saletype == 5)
                                    <button class="btn btn-info" type="button">Join DWW for Special Offers</button>
                                    @elseif(@$tire->saletype == 7)
                                    <button class="btn btn-info" type="button">See Price in Checkout</button>
                                    @endif
                                    </div></td>
                            </tr>
                        <!-- New Table End -->
                        </tbody>
                    </table>

                    <div class="row product-quantity">
                        <div class="col-sm-4 view-one">
                            <div class="input-group spinner">
                                <input type="text" name="quantity[]" class="quantity form-control" value="4" min="1" max="10">
                                <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 view-two">
                            <button class="btn btn-info addToCart" type="button" data-productid="{{$tire->id}}" data-price="{{roundCurrency(@$tire->price)}}"  data-modelid="#TireProductModal">Add to Cart</button>

                        </div>
                        <div class="col-sm-4 view-three"><button class="btn btn-info" type="button">FINANCE</button></div>
                    </div>

                    <div class="instock">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6 padd">
                                    <h1 class="instock-head">Availability :
                                        @if(@$tire->qtyavail == 1)
                                        <b>In Stock</b>
                                        @else
                                        <b>Low Stock - Call to Confirm</b>
                                        @endif
                                    </h1>
                                </div>
                                <div class="col-sm-6">
                                    <h1 class="instock-head animated pulse"><a href="" data-toggle="modal" data-target="#myModal">Shipping Quote</a></h1>
                                </div>
                                <!-- model Start -->
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog tire-view">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Shipping Quote</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group has-success has-feedback">
                                                        <label class="col-sm-5 control-label" for="inputSuccess">Ship To Zip</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="inputSuccess">
                                                        </div>
                                                    </div>
                                                </form>
                                                <button class="btn btn-info" type="button">Get Quote</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Model End  -->
                            </div>
                        </div>
                    </div>

                </div>


                @if(@$ratings)
                  <div class="col-sm-{{12/$divClass}} tir-des">
                      <div class="row">
                          <div class="col-sm-12">
                            <h2 class="product-name2">Performance Ratings</h2>

                            @if(@$tire->dry_performance > 0)
                            <h3 class="progress-title">Dry Handling / Dry Traction/ Dry Performance :</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->dry_performance??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->dry_performance??0}}%</div>
                                </div>
                            </div>
                            <br>
                            @endif
                            @if(@$tire->wet_performance > 0)
                            <h3 class="progress-title">Wet Braking/ Wet Traction/ Wet Performance :</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->wet_performance??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->wet_performance??0}}%</div>
                                </div>
                            </div>

                            <br>
                            @endif
                            @if(@$tire->mileage_performance > 0)
                            <h3 class="progress-title">Tread Life/ Mileage/ Wear :</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->mileage_performance??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->mileage_performance??0}}%</div>
                                </div>
                            </div>
                            <br>

                            @endif
                            @if(@$tire->ride_comfort > 0)
                            <h3 class="progress-title">Ride Comfort:</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->ride_comfort??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->ride_comfort??0}}%</div>
                                </div>
                            </div>

                            <br>
                            @endif
                            @if(@$tire->quiet_ride > 0)
                            <h3 class="progress-title">Quiet Ride/ Noise Comfort/ Quietness  :</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->quiet_ride??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->quiet_ride??0}}%</div>
                                </div>
                            </div>
                            <br>

                            @endif

                            @if(@$tire->winter_performance > 0)
                            <h3 class="progress-title">Winter Performance/ Snow Traction/ Snow :</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->winter_performance??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->winter_performance??0}}%</div>
                                </div>
                            </div>
                            <br>

                            @endif

                            @if(@$tire->fuel_efficiency > 0)
                            <h3 class="progress-title">Fuel Efficiency / Eco:</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->fuel_efficiency??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->fuel_efficiency??0}}%</div>
                                </div>
                            </div>
                            <br>
                            @endif


                            @if(@$tire->braking > 0)
                            <h3 class="progress-title">Braking:</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->braking??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->braking??0}}%</div>
                                </div>
                            </div>
                            <br>
                            @endif


                            @if(@$tire->responsiveness > 0)
                            <h3 class="progress-title">Responsiveness:</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->responsiveness??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->responsiveness??0}}%</div>
                                </div>
                            </div>
                            <br>
                            @endif

                            @if(@$tire->sport > 0)
                            <h3 class="progress-title">Sport:</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->sport??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->sport??0}}%</div>
                                </div>
                            </div>
                            <br>
                            @endif

                            @if(@$tire->off_road > 0)
                            <h3 class="progress-title">Off Road:</h3>
                            <div class="progress pink">
                                <div class="progress-bar" style="width:{{@$tire->off_road??0}}%; background:#0e1661;">
                                    <div class="progress-value">{{@$tire->off_road??0}}%</div>
                                </div>
                            </div>
                            <br>
                            @endif

                          </div>
                      </div>
                  </div>
                @endif
                @if(@$benefits)
                  <div class="col-sm-{{12/$divClass}} tire-benifit-des">
                      @if(@$tire->benefits1)
                      <div class="row tire-benifit">
                          <div class="col-sm-12">
                              <div class="col-sm-4 benifit">
                                  <img src="{{ViewBenefitImage(@$tire->benefitsimage1)}}">
                              </div>
                              <div class="col-sm-8 benifit-title">
                                  <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                  <p class="read_more_text" data-length="100">{{SplitBenefitHeading(@$tire->benefits1)}}</p>
                              </div>
                          </div>
                      </div>
                      @endif
                      @if(@$tire->benefits2)
                      <div class="row tire-benifit">
                          <div class="col-sm-12">
                              <div class="col-sm-4 benifit">
                                  <img src="{{ViewBenefitImage(@$tire->benefitsimage2)}}">
                              </div>
                              <div class="col-sm-8 benifit-title">
                                  <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                  <p class="read_more_text" data-length="100">{{SplitBenefitHeading(@$tire->benefits2)}}</p>
                              </div>
                          </div>
                      </div>
                      @endif
                      @if(@$tire->benefits3)
                      <div class="row tire-benifit">
                          <div class="col-sm-12">
                              <div class="col-sm-4 benifit">
                                  <img src="{{ViewBenefitImage(@$tire->benefitsimage3)}}">
                              </div>
                              <div class="col-sm-8 benifit-title">
                                  <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                  <p class="read_more_text" data-length="100">{{SplitBenefitHeading(@$tire->benefits3)}}</p>
                              </div>
                          </div>
                      </div>
                      @endif
                      @if(@$tire->benefits4)
                      <div class="row tire-benifit">
                          <div class="col-sm-12">
                              <div class="col-sm-4 benifit">
                                  <img src="{{ViewBenefitImage(@$tire->benefitsimage4)}}">
                              </div>
                              <div class="col-sm-8 benifit-title">
                                  <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                  <p class="read_more_text" data-length="100">{{SplitBenefitHeading(@$tire->benefits4)}}</p>
                              </div>
                          </div>
                      </div>
                      @endif
                  </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Video Start -->
    <div class="container">
        <div class="row youtube-video">
            <div class="col-sm-12 tire-video">
                @if(@$tire->youtube1)
                <div class="col-sm-3 video"><?php echo embedYoutube(@$tire->youtube1)?>
                </div>
                @endif
                @if(@$tire->youtube2)
                <div class="col-sm-3 video"><?php echo embedYoutube(@$tire->youtube2)?>
                </div>
                @endif
                @if(@$tire->youtube3)
                <div class="col-sm-3 video"><?php echo embedYoutube(@$tire->youtube3)?>
                </div>
                @endif
                @if(@$tire->youtube4)
                <div class="col-sm-3 video"><?php echo embedYoutube(@$tire->youtube4)?>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Video End -->

    </div>
    <!-- Cart End -->
</section>

<section id="demo-des">
    <div class="container">
        <div class="wheel-list-tab">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1default" data-toggle="tab" aria-expanded="true">Description</a></li>
                                <li><a href="#tab2default" data-toggle="tab">Shipping Information</a></li>
                                <li><a href="#tab3default" data-toggle="tab">Wheel and Tire Package</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content wheel-list-tab">
                                <div class="tab-pane fade active in " id="tab1default">
                                    <div class="col-sm-12">
                                        <div class="prod-headinghome">
                                            <br>
                                            <p><b>Details</b></p>
                                            @if(@$tire->detaildesctype)
                                            <p><b>Type</b>: {{@$tire->detaildesctype}}</p>
                                            @endif
                                            @if(@$tire->prodmodel)
                                            <p><b>Style</b>: {{@$tire->prodmodel}}</p>
                                            @endif
                                            @if(@$tire->detaildescfeatures)
                                            <p><b>Feature</b>: {{@$tire->detaildescfeatures}}</p>
                                            @endif
                                            <p><b>Description</b>:</p>
                                            <p><?php echo @$tire->proddesc ?></p>
                                        </div>
                                    </div>
                                    <!--  <div class="col-sm-4">
                                        <div class="tire-des">
                                            <a href="{{ViewTireImage(@$tire->prodimage)}}" class="zoomple">
                                            <img src="{{ViewTireImage(@$tire->prodimage)}}">
                                            </a>
                                        </div>
                                    </div> -->

                                </div>
                                <div class="tab-pane fade" id="tab2default">
                                    <div class="prod-headinghome">
                                         <?=Setting::get('shipping_rule','');?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3default">
                                    <div class="prod-headinghome">
                                         <?=Setting::get('wheelpackage','');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="rating-review">
    <div class="container">
        <div class="row review-heading2">
            <div class="col-sm-6 comment">
                <h2>Customer Review</h2>
            </div>
            <div class="col-sm-6 comment-button">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ReviewModal">Write a Review</button>
            </div>

            <!-- Modal Start -->
            <div class="modal comment-review fade" id="ReviewModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Write a Review</h4>
                        </div>
                            <form action="{{url('/addStarRating')}}" method="POST">
                                {{@csrf_field()}}
                                <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 second-star ">
                                                <h4 class="star-head">Product Ratings</h4>
                                                @foreach(getRatingList() as $ratingKey =>$rating)
                                                <div class="row product-rating">
                                                    <div class="col-sm-4">
                                                        <h5>{{$rating}}</h5>
                                                    </div>
                                                    <div class="col-sm-4 text-warning">
                                                        <div class='rating-stars text-center'>
                                                            <ul id='stars'>
                                                                <li class='star' title='Poor' data-value='1' data-ratingname='{{$ratingKey}}'>
                                                                    <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='Fair' data-value='2' data-ratingname='{{$ratingKey}}'>
                                                                    <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='Good' data-value='3' data-ratingname='{{$ratingKey}}'>
                                                                    <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='Excellent' data-value='4' data-ratingname='{{$ratingKey}}'>
                                                                    <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                                <li class='star' title='WOW!!!' data-value='5' data-ratingname='{{$ratingKey}}'>
                                                                    <i class='fa fa-star fa-fw'></i>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <h5 class="rating-text hide">Out of 5</h5>
                                                    </div>
                                                </div>
                                                @endforeach 
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-sm-12 form-group">
                                                <label for="comment">Comment:</label>
                                                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                            </div>
        
                                            <input type="hidden" id="ratings" name="ratings" value="">
                                            <input type="hidden" id="partno" name="partno" value="{{@$tire->partno}}">
                                            <input type="hidden" id="category" name="category" value="tire">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-info" value="Submit"  >
                                    <button type="button" class="btn btn-info btn-close" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <!-- Modal End -->
        </div>

        <div class="row">
            <div class="col-sm-4">
                <h4 class="star-head">Rating breakdown</h4>
                @for($i=5;$i>0;$i--)
                <div class="pull-left">
                    <div class="pull-left" style="width: 35px; line-height: 1;">
                        <div class="rate-star">{{$i}} <span class="glyphicon glyphicon-star"></span></div>
                    </div>
                    <div class="pull-left slider">
                        <div class="progress" style="height: 9px; margin: 8px 0;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="{{getReviewRatings($tire->partno,$i,'tire')}}" style="max-width: {{getReviewRatings($tire->partno,$i,'tire')}}%">
                                <!-- <span class="sr-only">80% Complete (danger)</span> -->
                            </div>
                        </div>
                    </div>
                    <div class="pull-right star-right" style="margin-left: 10px;">{{getReviewRatings($tire->partno,$i,'tire')}}</div>
                </div>
                @endfor
 
            </div> 

            <div class="col-sm-4 second-star ">
                <h4 class="star-head">Product Ratings</h4>
                @foreach(getRatingList() as $ratingkey => $ratingname)
                <div class="row product-rating">
                    <div class="col-sm-4">
                        <h5>{{$ratingname}}</h5>
                    </div>
                    <div class="col-sm-4 text-warning">
                        <div class='rating-stars text-center'>
                            <ul id='stars'>
                                <li class='star {{(getFeatureRatings($tire->partno,$ratingkey,"tire") >= 1 )?"selected":""}}' title='Poor' data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star {{(getFeatureRatings($tire->partno,$ratingkey,"tire") >= 2 )?"selected":""}}' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star {{(getFeatureRatings($tire->partno,$ratingkey,"tire") >= 3 )?"selected":""}}' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star {{(getFeatureRatings($tire->partno,$ratingkey,"tire") >= 4 )?"selected":""}}' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star {{(getFeatureRatings($tire->partno,$ratingkey,"tire") >= 5 )?"selected":""}}' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="rating-text hide">Out of 5</h5>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
        @if(@$tire->Reviews->count() > 0)
        <div class="row review-heading">
            <div class="col-sm-12">
                <h4>Most Helpful Favorable Review</h4>
            </div>
        </div>
        <div class="row">
            @foreach($tire->Reviews as $key =>  $review)
            <div class="col-sm-6">
                <hr />
                <div class="review-block">
                    <div class="row">
                        <div class="col-sm-3 user-image">
                            <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded" />
                            <div class="review-block-name"><a href="#">{{$review->name?:'User Review'}}</a></div>
                            <div class="review-block-date">
                                {{@$review->created_at}}<br />
                                {{@$review->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="review-block-rate">
                                <div class='rating-stars text-left'>
                                     <ul id='stars'>
                                        <li class='star {{($review->avgrating >= 1 )?"selected":""}}' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->avgrating >= 2 )?"selected":""}}' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->avgrating >= 3 )?"selected":""}}' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->avgrating >= 4 )?"selected":""}}' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->avgrating >= 5 )?"selected":""}}' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="review-block-title">{{getLimitedWords($review->comment,5)}}</div>
                        </div>

                        <div class="col-sm-5 ">
                            @foreach(getRatingList() as $ratingKey =>$rating)
                                <div class="row product-rating">
                                    <div class="col-sm-2 ">
                                        <h5>{{$rating}}</h5>
                                    </div>
                                    <div class="col-sm-10 text-warning">
                                        <div class='rating-stars text-center'> 
                                            <ul id='stars'>

                                        <li class='star {{($review->Ratings()->where("feature",$ratingKey)->first()->rating >= 1 )?"selected":""}}' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        <li class='star {{($review->Ratings()->where("feature",$ratingKey)->first()->rating >= 2 )?"selected":""}}' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->Ratings()->where("feature",$ratingKey)->first()->rating >= 3 )?"selected":""}}' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->Ratings()->where("feature",$ratingKey)->first()->rating >= 4 )?"selected":""}}' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star {{($review->Ratings()->where("feature",$ratingKey)->first()->rating >= 5 )?"selected":""}}' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                            </ul>
                                        </div>
                                    </div> 
                                </div>
                            @endforeach 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="review-block-description">
                                <p class="read_more_text" data-length="300">{{@$review->comment}}</p>
                            </div>
                        </div>
                    </div>

                    <hr />
             <!--        <div class="row">
                        <div class="col-sm-3 user-image">
                            <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded" />
                            <div class="review-block-name"><a href="#">nktailor</a></div>
                            <div class="review-block-date">
                                June 26, 2020<br />
                                1 day ago
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="review-block-rate">
                                <div class='rating-stars text-left'>
                                    <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="review-block-title">this was nice in buy</div>
                            <div class="review-block-description">
                                this was nice in buy. this was nice in buy. this was nice in buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this was nice in buy
                            </div>
                        </div>
                    </div>
                    <hr /> -->
                </div>
            </div>
            @endforeach
 
        </div>
        @endif
    </div>
</section> 

@if(ViewExistImage(@$tire->prodbrand.'-Company-Info.jpg'))
<section id="falken-info">
    <div class="container">
        <a href=""><img src="{{ViewExistImage(@$tire->prodbrand.'-Company-Info.jpg')}}" class="lazy ri" alt="Wheel Visualizer" width="100%" height="auto"></a>
    </div>
</section>
@endif
<section id="fal-feature">
    <div class="container">
        <div class="row">
            @foreach(@$similar_tires->take(6) as $key => $stire)
            <div class="col-sm-2">
                <div class="product-layouts">
                    <div class="product-thumb transition">
                        <div class="image">
                            <img class="wheelImage image_thumb" src="{{ViewTireImage(@$stire->prodimage)}}" title="" alt="" style="cursor: zoom-in;">
                            <img class="wheelImage image_thumb_swap" src="{{ViewTireImage(@$stire->prodimage)}}" title="" alt="" style="cursor: zoom-in;">
                            <div class="sale-icon"><a></a></div>
                        </div>
                        <div class="thumb-description">
                            <div class="caption">
                                <h4 class="tire-type"><a href="{{url('/tireview')}}/{{base64_encode(@$stire->id)}}/{{base64_encode(@$vehicle->id)}}">

                                        {{@$stire->detailtitle}}</a></h4>
                            </div>
                            <div class="button-group">
                                <button class="btn-cart" type="button" title="Add to Cart" onclick="cart.add('46');"><i class="fa fa-shopping-cart"></i>
                                    <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                </button>
                                <button class="btn-wishlist" title="Add to Wish List" onclick="wishlist.add('46');"><i class="fa fa-heart"></i>
                                    <span title="Add to Wish List">Add to Wish List</span>
                                </button>
                                <button class="btn-compare" title="Add to compare" onclick="compare.add('46');"><i class="fa fa-exchange"></i>
                                    <span title="Add to compare">Add to compare</span>
                                </button>
                                <button class="btn-quickview" type="button" title="Quick View"> <i class="fa fa-eye"></i>
                                    <span>Quick View</span>
                                </button>
                            </div>
                        </div>

                        <div class="thumb-description-price-details">
                              <span class="price-new"><b>{{roundCurrency(@$stire->price)}}</b></span>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
<div class="container">
    <!-- model Start -->
    <div class="modal fade " id="TireProductModal" role="dialog">
        <div class="modal-dialog wheel-view">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-left">Add To Cart</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                  <!-- <h2 class="modal-title"><b>Your Vehicle</b> : 2020 Acura RDX Base</h2> -->
                  <h2 class="modal-title modal-sub-title">The following items have been added to your cart:</h2>
                  <p class="modal-msg">Qty: 4 2 Crave Wheels No.1 22x8.5 Gloss Black with Machined Face +38mm Offset $160.00/ea</p>
                    <form class="form-horizontal">
                        <div class="form-group has-success has-feedback text-center">
                            <button class="btn btn-info btn-close" type="button" data-dismiss="modal" >Continue Shopping</button>
                            <!-- <button class="btn btn-info" type="button">Add Matching Tires</button> -->
                            <a class="btn btn-info cart-btn" href="{{url
                            ('/CartItems')}}"><i class="fa fa-shopping-cart"></i> View Cart</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Model End  -->
</div>
</section>

@endsection @section('custom_scripts')

<script>
    if($('.zoomple').length > 0){

        $('.zoomple').zoomple({
            offset : {x:-100,y:-100},
            zoomWidth : 130,
            zoomHeight : 130,
            roundedCorners : true
        });
    }
</script>

<script>
$(function(){

$('.spinner .btn:first-of-type').on('click', function() {
  var btn = $(this);
  var input = btn.closest('.spinner').find('input');
  if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {
    input.val(parseInt(input.val(), 10) + 1);
  } else {
    btn.next("disabled", true);
  }
});
$('.spinner .btn:last-of-type').on('click', function() {
  var btn = $(this);
  var input = btn.closest('.spinner').find('input');
  if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {
    input.val(parseInt(input.val(), 10) - 1);
  } else {
    btn.prev("disabled", true);
  }
});

})
</script>



<script type="text/javascript">
    
    $('.addToCart').click(function(){ 
 
        if("{{@base64_decode($wheelproduct_id)}}")
        {
            var qty = 4;
        }else{

            var qty = $('.quantity').val();
        }

        var modelid="#TireProductModal";
        var productid = $(this).data('productid');
        var price = $(this).data('price'); 
        var prodtype ='tire';
        var modalMsg = "Qty: "+qty+", "+$('.tire-detail-title').text()+" "+price+"/ea";

        $.ajax({url: "/addToCart",data:{'qty':qty,'productid':productid,'prodtype':prodtype,'price':price}, success: function(result){
            if(result['status'] =='success'){
                $(modelid).find('.modal-msg').html(result['message']+'<br>'+modalMsg);
                $(modelid).modal("show");
            }

            if (result['status'] == 'failed') {
                $(modelid).find('.modal-sub-title').html('');
                $(modelid).find('.modal-msg').html(result['message']+'<br>'+modalMsg);
                $(modelid).modal("show");
            }
            getCartCount();
            // $(".se-pre-con").hide(); 
        }});
    })


    // Start Rating
    $(document).ready(function() {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });

        var elems = {};

        /* 2. Action to perform on click */
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($(this).data('value'), 10);
            var ratingName = $(this).data('ratingname');
            // console.log(ratingName,ratingValue)

            // if ($('.product-details').find('tr:visible')) {
                // var partno = $('.product-details').find('tr:visible').find('.partno-data').data('partno');
                // elems.push(ratingValue); 
                elems[ratingName] = ratingValue;

                $('#ratings').val(JSON.stringify(elems)); //store array

                // $('#partno').val(partno);

                // var value = $('#ratings').val(); //retrieve array
                // value = JSON.parse(value);
                // console.log(value)
                // var prodtype = 'wheel'; 

                
            // }


            // alert(ratingValue)
            // var msg = "";
            // if (ratingValue > 1) {
            //     msg = "Thanks! You rated this " + ratingValue + " stars.";
            // } else {
            //     msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            // }
            // responseMessage(msg);

        });


    });


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
    // Star Rating End
</script>


<script type="text/javascript">
    
    $(document).on('click', '#zoomple_image_overlay', function() {
        $('.wheelImageNew').trigger( "click" ); 
    });

</script>


     <script src="{{ asset('js/preview-image.js') }}"></script>

@endsection
