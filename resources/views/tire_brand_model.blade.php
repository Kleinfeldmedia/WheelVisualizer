@extends('layouts.app') @section('shop_by_vehicle_css')
<link rel="stylesheet" href="{{ asset('css/wheels.css') }}"> @endsection @section('content')

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
        background: #000;
    }

    .pTopCell {
        display: table-cell;
        width: 50%;
        color: #fff;
        text-shadow: 0 1px 1px rgba(0, 0, 0, .75);
        font-weight: 700;
        font-size: 12px;
    }

    .pTopCell.Phone a {
        color: #fff;
        text-decoration: none;
        font-size: 12px;
    }

    .product-details table.product-info {
        margin: 15px 0;
    }

    .product-name {
        font-size: 14px !important;
        font-family: Montserrat !important;
        text-align: left;
        font-weight: 100 !important;
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
        color: #fff !important;
        background: #ecb23d !important;
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

    #table-section thead {
        background: #0e1661 !important;
        color: #fff !important;
        font-size: 12px;
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
        font-family: Montserrat !important;
        border: none !important;
    }

    .btn.btn-default.cart-2 {
        border-radius: 0% !important;
        color: #fff !important;
        background: green;
        font-size: 10px !important;
        font-family: Montserrat !important;
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

    .progress-title {
        font-size: 10px;
        color: #000 !important;
        margin: 5px 0px !important;
        text-align: left !important;
        font-family: Poppins !important;
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
        font-family: Poppins !important;
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

    .col-sm-6.tire-details img {
        width: 100% !important;
        height: 300px;
        max-height: 100px;
        max-width: 100px;
    }

    .benifit img {
        width: 100%;
    }

    .benifit-head {
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
        color: #000 !important;
        text-align: left;
        line-height: 25px !important;
        margin: 0px 0px;
        font-family: Poppins !important;
    }

    .video img {
        width: 100% !important;
    }


    .youtube-video {
        margin: 20px 0px !important;
    }

    .video img {
        width: 100% !important;
    }

    .prod-headinghome p {
        margin: 10px 0px;
        color: #121214;
        font-size: 12px !important;
        line-height: 30px !important;
        font-family: Poppins !important;
    }

    .prod-headinghome {
        text-align: left !important;
    }

    .prod-headinghome h2 {
        color: #0e1661 !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        margin: 10px 0px !important;
        font-family: Montserrat !important;
    }

    .product-name {
        margin: 0px 0px !important;
    }

    .prod-headinghome p {
        font-size: 12px !important;
        line-height: 30px !important;
    }

    .prod-headinghome img {
        margin: 10px 10px !important;
    }

    .tab-pane {
        text-align: center;
    }

    .shop-details .tab-pane img {
        height: 250px !important;
    }

    .nav-img>li>a {
        padding: 6px 5px !important;
        border: none !important;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        cursor: pointer;
        background: none !important;
    }

    .nav.nav-tabs.nav-img {
        border-bottom: 0px !important;
    }

    .nav-img>li>a:hover {
        background: none !important;
    }

    .shop-details .tab-content {
        margin-bottom: 0px !important;
    }

    .prod-headinghome img {
        width: 70px;
        height: 70px;
    }

    .nav-img img {
        width: 100px;
        height: 100px;
        padding: 5px 12px !important;
        border: 5px solid #0e166196 !important;
    }

    .nav-img :hover img {
        border: 5px solid #ecb23d70 !important;
    }

    .prod-headinghome h1 {
        font-family: Montserrat !important;
        font-size: 15px !important;
        font-weight: 100 !important;
    }

    .product-name2 {
        font-size: 14px !important;
        font-family: Montserrat !important;
        text-align: left;
        font-weight: 700 !important;
        margin-top: 10px !important;
        margin-bottom: 20px !important;
    }

    .slider-tires-6 {
        width: 50% !important;
        margin: auto !important;
    }

    .slider-tires-4 {
        width: 80% !important;
        margin: auto !important;
    }

    .slider-tires-3 {
        width: 100% !important;
        margin: auto !important;
    }

    .btn.btn-info {
        background: #ecb23d !important;
        font-family: Montserrat !important;
        font-size: 12px !important;
    }

    .btn.btn-info:hover {
        background: #0e1661 !important;
    }
</style>

<section id="tires-des">
    <!-- Cart Start -->
    <div class="container">

        <div class="hometabled">

            <div class="row">
                <?php $divClass=2;$benefits=false;$ratings=false;?>
                @if(@$tire->benefits1 || @$tire->benefits2 || @$tire->benefits3 || @$tire->benefits4)
                <?php $divClass+=1;$benefits=true;?>
                @endif
                @if(@$tire->dry_performance > 0 ||@$tire->wet_performance > 0 ||@$tire->mileage_performance > 0 ||@$tire->ride_comfort > 0 ||@$tire->quiet_ride > 0 ||@$tire->winter_performance > 0 ||@$tire->fuel_efficiency > 0 || @$tire->braking > 0 || @$tire->responsiveness > 0 || @$tire->sport > 0 || @$tire->handling > 0 || @$tire->off_road > 0 )
                <?php $divClass+=1;$ratings=true;?>
                @endif
                <div class="col-sm-{{12/$divClass}} tire-details">
                    <div class="prod-headinghome">
                        <h2>{{@$tire->prodmodel}}</h2>
                        <p class="read_more_text" data-length="650">{{@$tire->prodlandingdesc}}</p>
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
                </div>

                <div class="col-sm-{{12/$divClass}}  shop-details">



                    <div class="tab-content">
                        @if(ViewProductImage(@$tire->prodimage1) || ViewProductImage(@$tire->prodimage2) || ViewProductImage(@$tire->prodimage3))
                        @if(ViewProductImage(@$tire->prodimage1))
                        <div id="home" class="tab-pane fade in active">
                            <img src="{{ViewProductImage(@$tire->prodimage1)}}">
                        </div>
                        @endif
                        @if(ViewProductImage(@$tire->prodimage2))
                        <div id="menu1" class="tab-pane fade">
                            <img src="{{ViewProductImage(@$tire->prodimage2)}}">
                        </div>
                        @endif
                        @if(ViewProductImage(@$tire->prodimage3))
                        <div id="menu2" class="tab-pane fade">
                            <img src="{{ViewProductImage(@$tire->prodimage3)}}">
                        </div>
                        @endif
                        @else
                        <div id="home" class="tab-pane fade in active">
                            <img src="{{ViewImage(@$tire->prodimage)}}">
                        </div>
                        @endif

                    </div>
                    @if(ViewProductImage(@$tire->prodimage1) || ViewProductImage(@$tire->prodimage2) || ViewProductImage(@$tire->prodimage3))
                    <ul class="nav nav-tabs nav-img slider-tires-{{12/$divClass}}">
                        @if(ViewProductImage(@$tire->prodimage1))
                        <li class="active"><a data-toggle="tab" href="#home"><img src="{{ViewProductImage(@$tire->prodimage1)}}"></a></li>
                        @endif
                        @if(ViewProductImage(@$tire->prodimage2))
                        <li><a data-toggle="tab" href="#menu1"><img src="{{ViewProductImage(@$tire->prodimage2)}}"></a></li>
                        @endif
                        @if(ViewProductImage(@$tire->prodimage3))
                        <li><a data-toggle="tab" href="#menu2"><img src="{{ViewProductImage(@$tire->prodimage3)}}"></a></li>
                        @endif
                    </ul>
                    @endif
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
                            <h3 class="progress-title">Quiet Ride/ Noise Comfort/ Quietness :</h3>
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
                                <li class="active"><a href="#tab1default" data-toggle="tab">Description</a></li>
                                <li><a href="#tab2default" data-toggle="tab">Shipping Information</a></li>
                                <li><a href="#tab3default" data-toggle="tab">Wheel and Tire Package</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content wheel-list-tab">
                                <div class="tab-pane fade in active" id="tab1default">
                                    <div class="col-sm-12">
                                        <div class="prod-headinghome">
                                            <h1><b>Details</b></h1>
                                            <p><b>Type</b>: {{@$tire->detaildesctype}}</p>
                                            <p><b>Style</b>: {{@$tire->prodmodel}}</p>
                                            <p><b>Feature</b>: {{@$tire->detaildescfeatures}}</p>
                                            <h1><b>Description</b>:</h1>
                                            <p class="read_more_text" data-length="500"><?php echo @$tire->proddesc ?></p>
                                        </div>
                                    </div>
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


<section id="table-section">
    <div class="container">
        <div class="table-responsive table-bordered">
            <table class="table table-section">
                <thead>
                    <tr>
                        <th>Trim Size</th>
                        <th>Part No</th>
                        <th>UTQG Rating</th>
                        <th>Speed Rating</th>
                        <th>Load Rating</th>
                        <th>Warranty</th>
                        <th>Per Tire</th>
                        <th>Add To Cart</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(@$diff_tires as $key => $tire)
                    <tr>
                        <td><a href="{{url('/tireview/'.base64_encode($tire->id))}}">{{@$tire->tiresize}}</a></td>
                        <td>{{@$tire->partno}}</td>
                        <td>{{@$tire->utqg?:'-'}}</td>
                        <td>{{@$tire->speedrating?:'-'}}</td>
                        <td>{{@$tire->loadindex?:'-'}}</td>
                        <td>{{@$tire->warranty?:'-'}}</td>
                        <!-- <td><img src="{{url('image/'.@$tire->warranty)}}" width="35px" height="35px"></td> -->
                        <td>{{roundCurrency(@$tire->price)}}</td>
                        <td>
                            <a href="{{url('/tireview/'.base64_encode($tire->id))}}" class="btn btn-default cart-1">Details</a>
                            <button type="button" class="btn btn-default cart-2 addToCart" data-productid="{{@$tire->id}}" data-producttitle="{{@$tire->detailtitle}}" data-price="{{@$tire->price}}">Add</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                                <button class="btn btn-info btn-close" type="button" data-dismiss="modal">Continue Shopping</button>
                                <button class="btn btn-info" type="button">Add Matching Tires</button>
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

<!-- Read More Script Start-->
<script>
    function moreLess(initiallyVisibleCharacters) {
        var visibleCharacters = initiallyVisibleCharacters;
        var paragraph = $(".text")


        paragraph.each(function() {
            var text = $(this).text();
            var wholeText = text.slice(0, visibleCharacters) + "<span class='ellipsis'>... </span><a href='#' class='more'>Read More</a>" + "<span style='display:none'>" + text.slice(visibleCharacters, text.length) + "<a href='#' class='less'> Read Less</a></span>"

            if (text.length < visibleCharacters) {
                return
            } else {
                $(this).html(wholeText)
            }
        });
        $(".more").click(function(e) {
            e.preventDefault();
            $(this).hide().prev().hide();
            $(this).next().show();
        });
        $(".less").click(function(e) {
            e.preventDefault();
            $(this).parent().hide().prev().show().prev().show();
        });
    };

    moreLess(100);
</script>
<!-- Read More Script End-->




<script type="text/javascript">
    $('.addToCart').click(function() {
        var modelid = "#TireProductModal";
        var qty = 4;
        var productid = $(this).data('productid');
        var producttitle = $(this).data('producttitle');
        var price = $(this).data('price');
        var producttype = 'tire';
        var modalMsg = "Qty: " + qty + ", " + producttitle + " " + price + "/ea";

        $.ajax({
            url: "/addToCart",
            data: {
                'qty': qty,
                'productid': productid,
                'producttype': producttype,
                'price': price
            },
            success: function(result) {
                console.log(result);            
                if(result['status'] =='success'){
                    $(modelid).find('.modal-msg').text(modalMsg);
                    $(modelid).modal("show");
                }

                if (result['status'] == 'failed') {
                    $(modelid).find('.modal-sub-title').html('');
                    $(modelid).find('.modal-msg').html(result['message']+'<br>'+modalMsg);
                    $(modelid).modal("show");
                }

                getCartCount();
                // $(".se-pre-con").hide(); 
            }
        });
    })
</script>


@endsection