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

    .product-name 
    {
        font-size: 14px !important;
        font-family: oswald !important;
        text-align: left;
        font-weight: 100 !important;
    }


    .with-nav-tabs.panel-default .nav-tabs > li > a,
    .with-nav-tabs.panel-default .nav-tabs > li > a:hover,
    .with-nav-tabs.panel-default .nav-tabs > li > a:focus {
        color: #777;
    }

    .with-nav-tabs.panel-default .nav-tabs > .open > a,
    .with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
    .with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
    .with-nav-tabs.panel-default .nav-tabs > li > a:hover,
    .with-nav-tabs.panel-default .nav-tabs > li > a:focus {
        color: #fff !important;
        background: #ecb23d !important;
        border-color: transparent;
    }

    .with-nav-tabs.panel-default .nav-tabs > li.active > a,
    .with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
    .with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
        color: #555;
        background-color: #fff;
        border-color: #ddd;
        border-bottom-color: transparent;
    }

    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
        background-color: #f5f5f5;
        border-color: #ddd;
    }

    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
        color: #777;
    }

    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
        background-color: #ddd;
    }

    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
    .with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
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
        background:#0e1661 !important;
        color: #fff !important;
        font-size: 12px !important;
        font-weight: 100 !important;
        font-family: oswald !important;
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
        font-family:oswald !important;
    }

    .btn.btn-default.cart-2 {
        border-radius: 0% !important;
        color: #fff !important;
        background: green;
        font-size: 10px !important;
        font-family:oswald !important;
    }

    .table.table-section th {
        text-align: center !important;
    }

    .table.table-section td {
        text-align: center !important;
        color: #000 !important;
        font-size: 12px !important;
        transition: 1s all;
        font-family:play !important;
    }

    .table.table-section td:hover {
        text-decoration: underline;
        transition: 1s all;
        color: blue !important;
        cursor: pointer;
    }

    .table > tbody > tr > td {
        border: 1px solid #ddd;
    }

    .btn.btn-default.cart-1:hover,
    .btn.btn-default.cart-2:hover {
        text-decoration: underline;
    }
    .progress-title{
        font-size: 12px;
        color: #011627;
        margin:10px 0px !important;
        text-align:left !important;
        font-family:play !important;
    }
    .progress{
        height: 10px;
        background: #cbcbcb;
        border-radius: 0;
        box-shadow: none;
        margin-bottom: 0px;
        overflow: visible;
    }
    .progress .progress-bar{
        box-shadow: none;
        position: relative;
        -webkit-animation: animate-positive 2s;
        animation: animate-positive 2s;
    }
    .progress .progress-value{
        font-size: 12px;
        color: #000;
        position: absolute;
        top: 10px;
        right: 0;
        font-family:play !important;
    }

    @-webkit-keyframes animate-positive{
        0% { width: 0; }
    }
    @keyframes animate-positive{
        0% { width: 0; }
    }

    .col-sm-6.tire-details img {
        width: 100% !important;
        height: 300px;
    }

    .benifit img {
        width: 100% !important;
    }

    .benifit-head {
        font-size: 12px !important;
        font-weight: 100 !important;
        margin: 0px 0px !important;
        padding: 2px 0px;
        text-align: left;
        font-family: oswald !important;
    }

    .row.tire-benifit {
        padding: 5px 0px !important;
    }

    .benifit-title p {
        font-size: 12px !important;
        text-align: left;
        line-height: 25px !important;
        margin: 0px 0px;
        font-family: play !important;
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
        font-family: play !important;
    }
    .prod-headinghome {
      text-align: left !important;
    }
    .prod-headinghome h2 {
      color: #0e1661 !important;
      font-size: 25px !important;
      font-weight: 700 !important;
      margin:10px 0px !important;
      font-family: oswald !important;
    }
    .product-name
    {
      margin:0px 0px !important;
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
.shop-details .tab-pane img
{
  width: 100px !important;
  height: 150px !important;
}
.nav-img > li > a
{
  padding: 6px 5px !important;
  border:none !important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover
{
  cursor: pointer;
  background:none !important;
}
.nav.nav-tabs.nav-img {
    border-bottom: 0px !important;
}
.nav-img > li > a:hover
{
  background:none !important;
}
.shop-details .tab-content
{
  margin-bottom: 0px !important;
}
.prod-headinghome img
{
  width: 70px;
  height:70px;
}
.nav-img img
{
  width: 100px;
  height:100px;
}
.prod-headinghome h1
  {
    font-family: oswald !important;
    font-size: 15px !important;
    font-weight: 100 !important;
    color:#0e1661 !important;
  }

@media (max-width: 767px)
{
  .prod-headinghome
  {
    text-align: center !important;
  }
  .nav-img > li > a
  {
    padding: 10px 5px !important;
    border: none !important;
  }
  .col-sm-3.shop-details,.col-sm-3.tir-des
  {
    margin: 25px 0px !important;
  }
  .video img {
    width: 100% !important;
    padding: 10px 0px !important;
  }
  .benifit-title p,.benifit-head
  {
    text-align: center;
  }
  .col-sm-4.benifit img
  {
    width: 75% !important;
    margin: 10px 0px !important;
  }
  .active > div {
    display: unset !important;
  }
}
</style>

</section>
<section id="tires-des">
    <!-- Cart Start -->
    <div class="container">

        <div class="hometabled">

            <div class="row">
                <div class="col-sm-3 tire-details">
                  <div class="prod-headinghome">
                      <h2>{{@$tire->prodmodel}}</h2>
                      <p>{{@$tire->prodlandingdesc}}</p>
                      @if(@$tire->badge1)
                      <img src="{{viewImage('tires/badges/'.@$tire->badge1)}}">
                      @endif
                      @if(@$tire->badge2)
                      <img src="{{viewImage('tires/badges/'.@$tire->badge2)}}">
                      @endif
                      @if(@$tire->badge3)
                      <img src="{{viewImage('tires/badges/'.@$tire->badge3)}}">
                      @endif
                  </div>
                </div>

                <div class="col-sm-3 shop-details">

                  <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                      <img src="{{ViewProductImage(@$tire->prodimage1)}}">
                    </div>
                    <div id="menu1" class="tab-pane fade">
                      <img src="{{ViewProductImage(@$tire->prodimage2)}}">
                    </div>
                    <div id="menu2" class="tab-pane fade">
                      <img src="{{ViewProductImage(@$tire->prodimage3)}}">
                    </div>
                  </div>

                  <ul class="nav nav-tabs nav-img">
                    <li class="active"><a data-toggle="tab" href="#home"><img src="{{ViewProductImage(@$tire->prodimage1)}}"></a></li>
                    <li><a data-toggle="tab" href="#menu1"><img src="{{ViewProductImage(@$tire->prodimage2)}}"></a></li>
                    <li><a data-toggle="tab" href="#menu2"><img src="{{ViewProductImage(@$tire->prodimage3)}}"></a></li>
                  </ul>

                </div>


                <div class="col-sm-3 tir-des">
                    <div class="row">
                        <div class="col-sm-12">
                          <h1 class="product-name">Performance Ratings</h1>

                          <h3 class="progress-title">Dry Handling / Dry Traction/ Dry Performance :</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->dry_performance}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->dry_performance}}%</div>
                              </div>
                          </div>
                          <br>

                          <h3 class="progress-title">Wet Braking/ Wet Traction/ Wet Performance :</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->wet_performance}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->wet_performance}}%</div>
                              </div>
                          </div>
                          <br>
                          <h3 class="progress-title">Tread Life/ Mileage/ Wear :</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->mileage_performance}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->mileage_performance}}%</div>
                              </div>
                          </div>
                          <br>

                          <h3 class="progress-title">Ride Comfort:</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->ride_comfort}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->ride_comfort}}%</div>
                              </div>
                          </div>
                          <br>
                          <h3 class="progress-title">Quiet Ride/ Noise Comfort/ Quietness  :</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->quiet_ride}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->quiet_ride}}%</div>
                              </div>
                          </div>
                          <br>

                          <h3 class="progress-title">Winter Performance/ Snow Traction/ Snow :</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->winter_performance}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->winter_performance}}%</div>
                              </div>
                          </div>
                          <br>

                          <h3 class="progress-title">Fuel Efficiency / Eco:</h3>
                          <div class="progress pink">
                              <div class="progress-bar" style="width:{{@$tire->fuel_efficiency}}%; background:#0e1661;">
                                  <div class="progress-value">{{@$tire->fuel_efficiency}}%</div>
                              </div>
                          </div>
                          <br>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row tire-benifit">
                        <div class="col-sm-12">
                            <div class="col-sm-4 benifit">
                                <img src="{{ViewBenefitImage(@$tire->benefitsimage1)}}">
                            </div>
                            <div class="col-sm-8 benifit-title">
                                <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                <p>{{@$tire->benefits1}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row tire-benifit">
                        <div class="col-sm-12">
                            <div class="col-sm-4 benifit">
                                <img src="{{ViewBenefitImage(@$tire->benefitsimage2)}}">
                            </div>
                            <div class="col-sm-8 benifit-title">
                                <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                <p>{{@$tire->benefits2}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row tire-benifit">
                        <div class="col-sm-12">
                            <div class="col-sm-4 benifit">
                                <img src="{{ViewBenefitImage(@$tire->benefitsimage3)}}">
                            </div>
                            <div class="col-sm-8 benifit-title">
                                <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                <p>{{@$tire->benefits3}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row tire-benifit">
                        <div class="col-sm-12">
                            <div class="col-sm-4 benifit">
                                <img src="{{ViewBenefitImage(@$tire->benefitsimage4)}}">
                            </div>
                            <div class="col-sm-8 benifit-title">
                                <!-- <h1 class="benifit-head">WIDE ANGLED TREAD SLOT</h1> -->
                                <p>{{@$tire->benefits4}}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Video Start -->
    <div class="container">
        <div class="row youtube-video">
            <div class="col-sm-12 tire-video">
                <div class="col-sm-3 video"><?php echo embedYoutube('https://www.youtube.com/watch?v=uobjGGIjV-Y')?>
                </div>
                <div class="col-sm-3 video"><?php echo embedYoutube('https://www.youtube.com/watch?v=TdR_KUfM1z0')?>
                </div>
                <div class="col-sm-3 video"><?php echo embedYoutube('https://www.youtube.com/watch?v=uobjGGIjV-Y')?>
                </div>
                <div class="col-sm-3 video"><?php echo embedYoutube('https://www.youtube.com/watch?v=TdR_KUfM1z0')?>
                </div>
<!--                 <div class="col-sm-3 video"><img src="{{url('image/video.jpg')}}"></div>
                <div class="col-sm-3 video"><img src="{{url('image/video.jpg')}}"></div>
                <div class="col-sm-3 video"><img src="{{url('image/video.jpg')}}"></div> -->
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
                                    <div class="col-sm-8">
                                        <div class="prod-headinghome">
                                        <h1><b>Details</b></h1>
                                            <!-- <br><b>Type</b>: {{@$tire->Passenger}} -->
                                            <p><b>Style</b>: {{@$tire->prodmodel}}</p>
                                            <!-- <br><b>Feature</b>: Exclusive silica compound. 3D canyon siping. Wide angled tread slot. Wide circumferential grooves -->
                                            <h1><b>Description</b>:</h1>
                                            <?php echo @$tire->proddesc ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="tire-des">
                                            <img src="{{viewImage('/tires/'.@$tire->prodimage)}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab2default">
                                    <div class="prod-headinghome">
                                        <p>Welcome to Discounted wheel Warehouse. We offer a huge selection of rims and tires to suit your needs. We carry 15 inch wheels all the way to a whopping 32 inch custom wheel. We offer quality discount tires at a price range for all. Don't miss our Closeout section as we have the best blowout deals to offer. Whether you're looking for rims or tires Discounted Wheel Warehouse has the best deal on the world wide web. We also have all the latest news and information on our Blog concerning custom wheels or car rims and all aspects of tires.</p>
                                        <p>Welcome to Discounted wheel Warehouse. We offer a huge selection of rims and tires to suit your needs. We carry 15 inch wheels all the way to a whopping 32 inch custom wheel. We offer quality discount tires at a price range for all. Don't miss our Closeout section as we have the best blowout deals to offer. Whether you're looking for rims or tires Discounted Wheel Warehouse has the best deal on the world wide web. We also have all the latest news and information on our Blog concerning custom wheels or car rims and all aspects of tires.</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3default">
                                    <div class="prod-headinghome">
                                        <p>Welcome to Discounted wheel Warehouse. We offer a huge selection of rims and tires to suit your needs. We carry 15 inch wheels all the way to a whopping 32 inch custom wheel. We offer quality discount tires at a price range for all. Don't miss our Closeout section as we have the best blowout deals to offer. Whether you're looking for rims or tires Discounted Wheel Warehouse has the best deal on the world wide web. We also have all the latest news and information on our Blog concerning custom wheels or car rims and all aspects of tires.</p>
                                        <p>Welcome to Discounted wheel Warehouse. We offer a huge selection of rims and tires to suit your needs. We carry 15 inch wheels all the way to a whopping 32 inch custom wheel. We offer quality discount tires at a price range for all. Don't miss our Closeout section as we have the best blowout deals to offer. Whether you're looking for rims or tires Discounted Wheel Warehouse has the best deal on the world wide web. We also have all the latest news and information on our Blog concerning custom wheels or car rims and all aspects of tires.</p>
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
                        <td>${{@$tire->price}}</td>
                        <td>
                            <a href="{{url('/tireview/'.base64_encode($tire->id))}}" class="btn btn-default cart-1">Details</a>
                            <button type="button" class="btn btn-default cart-2">Add</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection @section('shop_by_vehicle_scripts')
<script src="{{ asset('js/wheels.js') }}"></script>

@endsection
