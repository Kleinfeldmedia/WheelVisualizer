
@extends('layouts.app') @section('shop_by_vehicle_css')
<link rel="stylesheet" href="{{asset('choosen/css/chosen.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/wheels.css') }}">

@endsection 
@section('metakeywords')
<?=@MetaViewer('Wheels');?>
@endsection 
@section('content')


<style>
.modal_canvas{
    min-height: 427px !important;
}
.col-sm-12.wheel-des p
{
    font-family: poppins !important;
    font-size: 12px !important;
    line-height: 30px !important;
    color: #000 !important;
    margin: 0px 0px !important;
    text-align:justify;
}
.col-sm-12.wheel-des b a
{
  font-size: 12px !important;
  font-family: Montserrat !important;
  color: #0e1661 !important;
}
.wheel-des
{
    padding: 20px 20px !important;
}

 
    .modal-header {
        background: #0e1661 !important;
        color: #fff !important;
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





</style>

@include('include.sizelinks')
<!-- BAnner Down Sestion Start -->
<section id="produst">
    <div class="container pro">
        <div class="row">
            <div class="col-sm-12 sub-head">
                <h1>{{implode(', ',json_decode(base64_decode(@Request::get('brand')?:''))?:[])}} Wheels</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 wheel-des">
                @forelse(@$branddesc as $desc)
                <p>{!! @$desc->proddesc !!}</p>
                @empty 
                @endforelse
            </div>
        </div>
        <div class="row main-pro">
            <div class="col-sm-3 main-pro-inner-category">
                <div class="header-bottom col-sm-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="price-heading">SIZE</div>
                                <!--  -->
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion123456" href="#collapseOne" class="{{(@Request::get('diameter'))?'':'collapsed123456'}}" aria-expanded="{{(@Request::get('diameter'))?'true':'false'}}" aria-controls="collapseOne">
                                                    Diameter
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse1 collapse in in123456 {{(@Request::get('diameter'))?' in':''}} " role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <ul style="list-style-type: none;">
                                                    @forelse($wheeldiameter as $diameter)
                                                    <li><input type="checkbox" name="wheeldiameter[]" class="wheeldiameter" value="{{$diameter->wheeldiameter}}" @if(in_array($diameter->wheeldiameter,json_decode(base64_decode(@Request::get('diameter')?:''))?:[])) checked @endif> {{$diameter->wheeldiameter.'('.$diameter->total.')'}}
                                                    </li>
                                                    @empty
                                                    <li>No Diameter Available</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion123456" href="#collapseTwo" class="{{(@Request::get('width'))?'':'collapsed123456'}}" aria-expanded="{{(@Request::get('width'))?'true':'false'}}" aria-controls="collapseTwo">
                                                    Width
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse2 collapse in in123456  {{(@Request::get('width'))?' in':''}}  " role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                <ul style="list-style-type: none;">
                                                    @forelse($wheelwidth as $width)
                                                    <li><input type="checkbox" name="wheelwidth[]" class="wheelwidth" value="{{$width->wheelwidth}}" @if(in_array($width->wheelwidth,json_decode(base64_decode(@Request::get('width')?:''))?:[])) checked @endif> {{$width->wheelwidth.'('.$width->total.')'}} </li>
                                                    @empty
                                                    <li>No width Available</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>key words
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion123456" href="#collapseThree" class="{{(@Request::get('brand'))?'':'collapsed123456'}}" aria-expanded="{{(@Request::get('brand'))?'true':'false'}}" aria-controls="collapseThree">
                                                    Brand
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse3 collapse in in123456" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                <ul style="list-style-type: none;">
                                                    @forelse($brands as $brand)
                                                    <li><input type="checkbox" name="brand[]" class="brand" value="{{$brand->prodbrand}}"
                                                        @if(in_array($brand->prodbrand,json_decode(base64_decode(@Request::get('brand')?:''))?:[]))
                                                             checked
                                                        @endif
                                                        >
                                                        @if(@$countsByBrand[$brand->prodbrand])
                                                        {{$brand->prodbrand}} ( {{$countsByBrand[$brand->prodbrand]}} )
                                                        @endif
                                                    </li>
                                                    @empty
                                                    <li>No Brands Available</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingFour">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion123456" href="#collapseFour" class="{{(@Request::get('width'))?'':'collapsed123456'}}" aria-expanded="{{(@Request::get('width'))?'true':'false'}}" aria-controls="collapseFour">
                                                    Finish
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse4 collapse in in123456  {{(@Request::get('finish'))?' in':''}}  " role="tabpanel" aria-labelledby="headingFour">
                                            <div class="panel-body">
                                                <ul style="list-style-type: none;">
                                                    @forelse($wheelfinish as $finish)
                                                    <li><input type="checkbox" name="finish[]" class="finish" value="{{$finish->prodfinish}}" 
                                                        @if(in_array($finish->prodfinish,json_decode(base64_decode(@Request::get('finish')?:''))?:[])) checked @endif> {{$finish->prodfinish.'('.$finish->total.')'}} </li>
                                                    @empty
                                                    <li>No Finish Available</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="col-sm-9 col-sm-9 main-pro-inner">
                <div class="row">
                  @if(@$vehicle || @$flag=='searchByWheelSize')
                  <div class="wheel-list-change-tab ">
                      <div class="row">
                          <div class="col-md-8 left-head">
                            <p> 
                                @if(@$vehicle)
                                Your Selected Vehicle: 
                                    <b>{{@$vehicle->year}} {{@$vehicle->make}} {{@$vehicle->model}} {{@$vehicle->submodel}} </b>
                                    @if(@$liftsize) &  Liftsize :  <b> {{@$liftsize}} </b> @endif
                                    @if(@$vehicle->dually=='1' && (@$offroadtype == 'stock' || @$offroadtype == null)) &  <b> Dually Wheels </b> @endif
                                    
                                <br>
                                @endif
                                @if(@$flag == 'searchByWheelSize' && @$request->wheeldiameter)

                                    Your Selected  
                                    @if(@$request->wheeldiameter)

                                    Diameter:
                                        <b>{{@$request->wheeldiameter}}</b> ,
                                    @endif

                                    @if(@$request->wheelwidth)
                                    Width:
                                        <b>{{@$request->wheelwidth}}</b> ,
                                    @endif

                                    @if(@$request->boltpattern)
                                    Bolt Pattern:
                                        <b>{{showBoltPattern(@$request->boltpattern)}}</b> ,
                                    @endif

                                    @if(@$request->minoffset)
                                    Offset:
                                        <b>{{@$request->minoffset}}</b> 
                                        @if(@$request->maxoffset)<b> to {{@$request->maxoffset}}</b> @endif
                                    @endif
                                @endif
                            </p> 
                          </div>
                          <div class="col-md-4 right-button"><button type="submit" class="btn vehicle-change"><a href="{{url('/wheelproducts')}}">Change</a></button></div>
                      </div>
                  </div>
                  @endif
                  @if(@$request->wheeltype)
                  <div class="wheel-list-change-tab "> 
                        <div class="row">
                          <div class="col-md-8 left-head">
                            <p> 
                                {{(base64_decode(@$request->wheeltype) == 'D')?'Dually Wheels':''}}
                                {{(base64_decode(@$request->wheeltype) == 'O')?'Offroad Wheels':''}}
                                {{(base64_decode(@$request->wheeltype) == 'C')?'Classic Wheels':''}} 
                                </p>
                            </div>
                        </div>

                  </div>
                  @endif
                  @if(@$zipcode)
                  <div class="wheel-list-change-tab ">
                      <div class="row">
                          <div class="col-md-8 left-head"> 
                                <p> 
                                    @if(@$zipcode)
                                    Your Zipcode: 
                                        <b>{{@$zipcode}}</b> 
                                    @endif 
                                    @if(!empty(\Session::get('user.state')))
                                    , State: 
                                        <b>{{\Session::get('user.state')}}</b> 
                                    @endif 
                                    @if(!empty(\Session::get('user.city')))
                                    , City: 
                                        <b>{{\Session::get('user.city')}}</b> 
                                    @endif 
                                </p>
                          </div>
                          <div class="col-md-4 right-button"><button type="submit" class="btn vehicle-change"><a href="{{url('/zipcodeClear')}}">Change</a></button></div>
                      </div>
                  </div>
                  @endif
                </div>
                <div class="row">
                    @forelse($products as $key => $product)
                        <?php $product = (object)$product; ?>
                        <div class="col-sm-4">
                            <div class="product-layouts">
                                <div class="product-thumb transition">
                                    <div class="image">
                                        <img class="wheelImage image_thumb" src="{{ViewWheelProductImage(@$product->prodimage)}}" title="{{@$product->prodbrand}}" alt="{{@$product->prodbrand}}">
                                        <img class="wheelImage image_thumb_swap" src="{{ViewWheelProductImage($product->prodimage)}}" title="{{$product->prodbrand}}" alt="{{$product->prodbrand}}">
                                        <div class="sale-icon"><a>Sale</a></div>
                                    </div>

                                    <div class="thumb-description">
                                        <div class="caption">
                                            <h4><a href="{{url('/wheelproductview',$product->id)}}{{@$flag?'/'.$flag:''}}{{'/'.str_replace(' ', '+', $product->detailtitle)}}">{{$product->detailtitle}}
                                                @if(@Request::get('diameter'))
                                                    <br> {{'Diameter : '.$product->wheeldiameter}}
                                                @endif
                                                @if(@Request::get('width'))
                                                    <br> {{'Width : '.$product->wheelwidth}}
                                                @endif
                                                    <!-- <br> {{'Diameter : '.$product->wheeldiameter}}
                                                    <br> {{'Width : '.$product->wheelwidth}}
                                                    <br> {{'prodmodel : '.$product->prodmodel}}
                                                     -->
                                                    <!-- <br> {{'PN : '.$product->partno}}  -->
                                    
                                                    
                                                     @if(@$product->distance)
                                                    <br> {{'Min.Distance : '.@$product->distance}} 
                                                    @endif
                                                </a>
                                              </h4>

                                            <!-- <div class="price">
                                                <span class="price-new">Starting at : {{roundCurrency(@$product->price)}}</span>
                                            </div> -->

                                        @if($car_images && @$zipcode)
                                        <button class="btn btn-primary {{
                                                    (!file_exists(front_back_path(@$product->wheel['image'])) && !file_exists(front_back_path(@$product->prodimage)) )?'disabled':''}}" {{(!file_exists(front_back_path(@$product->wheel['image'])) && !file_exists(front_back_path(@$product->prodimage)) )?' ':'data-toggle=modal'}} data-target="#myModal{{$key}}" onclick="WheelMapping('{{$key}}')" >See On Your Car</button>
                                        @endif
                                        </div>
                                        <div class="button-group">
                                            <a href="{{url('/wheelproductview',$product->id)}}{{@$flag?'/'.$flag:''}}">
                                            <button class="btn-cart" type="button" title="Add to Cart"><i class="fa fa-shopping-cart"></i>
                                                <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                            </button>
                                            </a>
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
                                      <span class="price-new">Starting at : {{roundCurrency(@$product->price)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @if($car_images && @$zipcode)

                    <input type="hidden" id="car_image_name" value="{{@$car_images->image}}">
                    <input type="hidden" id="car_image_id" value="{{@$car_images->car_id}}">
                    <!-- Model Car Start -->

                    <div class="modal fade" id="myModal{{$key}}"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        @if(@$car_images->CarViflist)
                                        {{@$car_images->CarViflist->yr}} -
                                        {{@$car_images->CarViflist->make}} -
                                        {{@$car_images->CarViflist->model}} -
                                        {{@$car_images->CarViflist->whls}}
                                        {{@$car_images->CarViflist->drs}}
                                        {{@$car_images->CarViflist->body}} 
                                        @else
                                        Your Car
                                        @endif
                                    </h4>
                                </div>
                                <div class="modal-body">    
                                    <div class="row main-model-body" >
                                        <div class="col-sm-12 model-car modal_canvas" id="modal_canvas_{{$key}}">

                                            <img id="car_image_{{$key}}" class="car_image_{{$key}} car_image_{{$car_images->car_id}} car_image_responsive" src="{{asset($car_images->image)}}" data-carid="{{$car_images->car_id}}" data-imagename="{{$car_images->image}}">

                                        </div>
                                        @if(@$product->wheel)
                                        @if(file_exists(front_back_path(@$product->wheel['image'])))
                                        <div class="car-wheel">
                                            <div class="front" >
                                                <img class="frontimg" src="{{front_back_path(@$product->wheel['image'])}}" id="image-diameter-front-{{$key}}" data-name="{{front_back_path(@$product->wheel['image'])}}" >
                                            </div>
                                            <div class="back">
                                                <img src="{{front_back_path(@$product->wheel['image'])}}" id="image-diameter-back-{{$key}}">
                                            </div>
                                        </div>
                                        @endif
                                        @else

                                        @if(file_exists(front_back_path(@$product->prodimage)))
                                        <div class="car-wheel">
                                            <div class="front" >
                                                <img class="frontimg" src="{{front_back_path(@$product->prodimage)}}" id="image-diameter-front-{{$key}}" data-name="{{front_back_path(@$product->prodimage)}}" >
                                            </div>
                                            <div class="back">
                                                <img src="{{front_back_path(@$product->prodimage)}}" id="image-diameter-back-{{$key}}">
                                            </div>
                                        </div>
                                        @endif
                                        @endif



                                    </div>

                                    <div class="row model-car-body">

                                        <div class="col-sm-4">
                                            <h1 class="model-car">Vechicle Color</h1>
                                            <ul class="list-color">
                                                @if(@$car_images->CarColor()->count() > 0)
                                                @foreach(@$car_images->CarColor()->get()->unique('rgb1') as $key1 => $color)
                                                @if(strlen($color->rgb1) ==6)
                                                <li class="color-radius car_color {{($color->code ==$car_images->color_code )?'color-selected':''}}" style="background:#{{$color->rgb1}};" title="{{$color->name}}" data-code="{{$color->code}}" data-vif="{{$color->vif}}"></li>
                                                @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h1 class="model-car">Wheel Diameter</h1>
                                            <button class="model-button diameter-up" data-id="{{$key}}">Zoom In</button>
                                            <button class="model-button diameter-down" data-id="{{$key}}">Zoom Out</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <h1 class="model-car">Share :</h1>
                                            <ul class="model-list-unstyled">
                                                <li class="facebook">
                                                    <a target="_blank" class="_blank" href="#" title="Facebook">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="twitter">
                                                    <a target="_blank" class="_blank" href="#" title="Twitter">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>

                                                <li class="google-plus">
                                                    <a target="_blank" class="_blank" href="#" rel="publisher" title="Google Plus">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                </li>
                                                <li class="pinterest">
                                                    <a target="_blank" class="_blank" href="#" rel="publisher" title="pinterest">
                                                        <i aria-hidden="true" class="fa fa-pinterest-p"></i>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Model Car End -->
                    @endif
                        @empty 
                     <div class="col-md-12 left-head text-center" >
                        <br>
                          <h5> <b>No Results found for your selected.Please try selecting a different brand or attribute on the left.</b> </h5>
                      </div>

                        @endforelse
                </div>

                <div class="row pro-pagination">
                    <div class="col-sm-6 pagi-left">
                        <p>{{(@$products->total())?@$products->total().' Wheels Found':''}} </p>
                    </div>
                    <div class="col-sm-6 pagi-right">
                        {{$products->appends([ 'diameter' => @Request::get('diameter'), 'width' => @Request::get('width'), 'brand' => @Request::get('brand'), 'car_id' => @Request::get('car_id'), 'page' => @Request::get('page'), 'flag' => @Request::get('flag'), 'make' => @Request::get('make'), 'year' => @Request::get('year'), 'model' => @Request::get('model'), 'submodel' => @Request::get('submodel'), 'zip' => @Request::get('zip'), 'wheeldiameter'=> @Request::get('wheeldiameter'), 'wheelwidth'=> @Request::get('wheelwidth'), 'boltpattern'=> @Request::get('boltpattern'), 'minoffset'=> @Request::get('minoffset'), 'maxoffset'=> @Request::get('maxoffset'),'liftsize' => @Request::get('liftsize'), ])->links()}}

                    </div>
                </div>
                <div class="modal fade" id="wheelZipcodeModal" role="dialog">
                    <div class="modal-dialog tire-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Zipcode</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="wheelZipcodeForm">
                                    <div class="form-group has-success has-feedback">
                                        <label class="col-sm-5 control-label" for="inputSuccess">Your Zipcode</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control"  name="zipcode" required="">
                                            {{@csrf_field()}}
                                        </div>
                                    </div>
                                    <div style="text-align:center;">
                                        <button class="btn btn-info" id="wheelZipcodeSubmit" type="button">Continue</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('custom_scripts')
    <!-- <script src="{{ asset('js/ajax/jquery.min.js') }}"></script> -->
    <script src="{{ asset('choosen/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script  src="{{ asset('js/opencv/opencv-3.3.1.js') }}" async></script>



<script type="text/javascript">
    var boxes;
    var wheelwidth;
    var $loading = $('.se-pre-con');
    // $(".se-pre-con").bind('ajaxStart', function(){
    //     $(this).show();
    // }).bind('ajaxStop', function(){
    //     $(this).hide();
    // });

    if("{{@$zipcode==''}}" && "{{@Request::get('flag') != 'searchByVehicle'}}"){

            $("#wheelZipcodeModal").modal({
                backdrop: 'static',
                keyboard: false
            }); 
    }

    if("{{@$zipcode==''}}" && "{{@Request::get('flag') == 'searchByVehicle'}}"){

            $("#zipcodeModal").modal({
                backdrop: 'static',
                keyboard: false
            }); 
    }


    $("#wheelZipcodeSubmit").click(function() {
        $.ajax({
            url: "/zipcodeUpdate",
            method: 'POST',
            data: $('#wheelZipcodeForm').serialize(),
            success: function(result) {
                console.log(result);
                if (result == 'success') {
                    $("#wheelZipcodeModal").modal('hide');
                    window.location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {


            }
        });
    }); 

 

    function getWheelPosition(key){  
        // $(".se-pre-con").show();
        imagePath = "{{public_path()}}/"+$('#car_image_name').val();
        // alert(imagePath)
        carid = $('#car_image_id').val(); 
        $loading.show();
        $.ajax({url: "/runPython",data:{'image':imagePath,'carid':carid}, 
            success: function(result){  
                // console.log(typeof result)
                console.log('After Response',new Date($.now()))
                boxes = JSON.parse(result.toString())
                console.log('Response Binded ')   
                var delay = 1000;
                setTimeout(function() 
                    {  
                    $loading.fadeOut("slow");
                    console.log('Waiting Time Closed')    
                    },
                    delay
                ) ;    
                // WheelMapping(JSON.parse(result));
                // setWheelPosition(result,key);
            },
            error: function (jqXHR, textStatus, errorThrown) {
            
                    $loading.fadeOut("slow");
            }
        });  
    }

    if ("{{@$zipcode}}" && "{{@!empty($car_images)}}") {
        getWheelPosition('0');

    } else {
        $loading.fadeOut("slow");
    }

    function WheelMapping(key){
        if(boxes == 'undefined'){
            getWheelPosition(key)
        }
        console.log('boxes',boxes)
        if(boxes[0][0] < 400 ){

            f = boxes[0];

            b = boxes[1];
        }else{

            f = boxes[1];

            b = boxes[0];
        }
           // d=f[3]-f[2];
        // if(d > 21){
        //     f[3] = f[2]+14;//+(f[2]/2);
        // }

        // d = f[3]-f[2];
        var front = $('#image-diameter-front-'+key);
        front.css('left',f[0]-18+'px');
        front.css('top',f[1]-1+'px');
        // var extraWidth=0;
        // if(front.width() - f[2] > 4)
        // {
        //     extraWidth=(front.width() - f[2])/2;
        // }
        // console.log(extraWidth)
        // front.width(front.width()+extraWidth+'px');
        // ,front[0]['clientWidth'],f[2]);
        // back.css('width',front.clientWidth-20+'px');
        

        // var front = $('#image-diameter-front-'+key);
        // front.css('left',f[0]-19+'px'); //
        // front.css('top',f[1]+2+'px');
        // front.width(f[2]+'px');
        // front.height(f[3]+'px');
        // // front.css('padding','5px')
        // d=b[3]-b[2];
        // if(b[2] < 50){
        //     b[2] = 60;
        // }
        // if(d > 21){
        //     b[3] = b[3]-15;//+(b[2]/2);
        // }

        // var back = $('#image-diameter-back-'+key);
        // back.css('left',b[0]-12+'px'); //
        // back.css('top',b[1]+9+'px'); //
        // back.width(b[2]+'px');
        // back.height(b[3]+'px');




        var back = $('#image-diameter-back-'+key);
        back.css('left',b[0]-11.5+'px');
        back.css('top',b[1]+8.5+'px');
        // back.css('width',b[2]+'px');






    }

</script>
@endsection
