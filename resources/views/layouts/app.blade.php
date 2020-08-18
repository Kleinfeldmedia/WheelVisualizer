 
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('metakeywords')

    <title>{{Setting::get('site_title','Wheel')}}</title>
    <link rel="stylesheet" href="{{ asset('css/ontheme/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/category-feature.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/opencart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('js/jquery/magnific/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery/datetimepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zoomple.css') }}">

    <!-- <link rel="stylesheet" href="http://localhost:8001/css/wheel-api-new3.css"> -->
    <link rel="stylesheet" href="http://web9.vtdns.net/css/wheel-api-new3.css">
 <style type="text/css">
.front_wheel img {
    width: 75px;
    position: absolute;
    content: '';
    top: 55%;
    left: 43%;
    bottom: 121%;
    right: 0;
    transform: perspective(0px) rotateY(37deg);
    object-fit: cover;
}
     .back_wheel img {
    width: 55px;
    position: absolute;
    content: '';
    top: 52%;
    left: 75.5%;
    bottom: 0;
    right: 0;
    transform: perspective(405px) rotateY(54deg);
    object-fit: cover;
}
 </style>



    @yield('styles')
    @yield('shop_by_vehicle_css')



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

</head>

<body>
    <main>
        <div class="se-pre-con"></div>
        <section>
            <div class="container-fluid home-page">
                @include('include.header')
                @include('include.flash')
                @yield('content')
                @include('include.brands')
                @include('include.footer')
            </div>
            <div id="Offroad-View-Section"></div>
            <div id="Offroad-Size-View-Section"></div>
            <div id="Zipcode-Section"></div>
        </section>
    </main>
    <!-- Main End -->
    <!-- Javascript Start -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/ontheme/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/ontheme/jquery.elevatezoom.min.js') }}"></script>
    <script src="{{ asset('js/ontheme/lightbox-2.6.min.js') }}"></script>
    <script src="{{ asset('js/swiper.jquery-.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/zoomple.js') }}"></script>

    @if(!(Request::has('car_id') || @Request::get('flag') == 'searchByVehicle'))
    <script type="text/javascript">
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
            console.log('First Loader Closed')
        });
    </script>

    @endif
 

    @yield('custom_scripts')
    @yield('header_scripts')
    @yield('footer_scripts')

    @yield('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.input').focus(function() {
                $(this).parent().find(".label-txt").addClass('label-active');
            });
            $(".input").focusout(function() {
                if ($(this).val() == '') {
                    $(this).parent().find(".label-txt").removeClass('label-active');
                };
            });
        });
    </script>
    <script type="text/javascript">
        if($('.gallery-top').length > 0){

            var galleryTop = new Swiper('.gallery-top', {
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
                loopedSlides: 4,
            });
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                slidesPerView: 4,
                centeredSlides: false,
                touchRatio: 0.2,
                slideToClickedSlide: true,
                loop: true,
                loopedSlides: 4,
            });
            galleryTop.controller.control = galleryThumbs;
            galleryThumbs.controller.control = galleryTop;
        }
    </script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script> -->
    <script>
    $(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
    });

    // var accesstoken= "{{@$request->accesstoken?:'Ykc5allXeG9iM04w'}}"//new3
    var accesstoken= "{{@$request->accesstoken?:'ZDJWaU5pNTJkR1J1Y3k1dVpYUT0='}}"//new3
    // Ykc5allXeG9iM04w
    // ZDJWaU5pNTJkR1J1Y3k1dVpYUT0=
    </script>

    <!-- <script src="http://localhost:8001/js/wheel-api-new3.js"></script>  -->
    <!-- <script src="http://web9.vtdns.net/js/wheel-api-new3.js"></script>  -->

    <script type="text/javascript">
var baseurl = "http://web9.vtdns.net"; 
// var baseurl = "http://localhost:8001";
var boxes;
var allData;
var widthAdjusted = true;

var make = $('.make').val();
var year = $('.year').val();
var model = $('.model').val();
var submodel = $('.submodel').val();
var changeBy = '';

var vehicle='';
var vehicleid='';
var offroadid='';
var flag='';
var zipcode='';
var offroadtype = '';
var liftsize = '';
var qryData = getUrlVars();

var $loading = $('.se-pre-con');
$(document).ready(function() {
    if("{{$request->pagename}}"){
        getWheelsList();
        getVisualiserModal();
    } 
    vehicleFilters(changeBy); 
});



// Year based filters for Makes 
$(document).on('change', '.year,.make,.model', function() {
    changeBy = $(this).attr('name');
    vehicleFilters(changeBy);
});

function vehicleFilters(changeBy = '') {  

    make = $('.make').val();
    year = $('.year').val();
    model = $('.model').val();
    submodel = $('.submodel').val();


    var data = {
        year: year,
        make: make,
        model: model,
        changeBy: changeBy,
        accesstoken: accesstoken
    } 

    $.ajax({
        url: baseurl + "/api/getVehicles",
        data: data,
        type: "POST", 
        success: function(result) {
            if (result['status'] == false) {

                alert(result['message']);
            }
            $('.submodel').empty().append('<option disabled selected>Select Submodel</option>');

            if (changeBy == '' || changeBy == 'year' || changeBy == 'make') {
                $('.model').empty().append('<option disabled selected>Select Model</option>');
            }
            if (changeBy == '' || changeBy == 'make') {
                $('.year').empty().append('<option disabled selected>Select Year</option>');
            }

            if (changeBy == '') {
                console.log(result)
                result.data['make'].map(function(value, key) {
                    isSelected = (value.make == make) ? 'selected' : '';
                    $('.make').append('<option value="' + value.make + '" ' + isSelected + '>' + value.make + '</option>');
                });

                result.data['year'].map(function(value, key) {
                    isSelected = (value.year == year) ? 'selected' : '';
                    $('.year').append('<option value="' + value.year + '" ' + isSelected + '>' + value.year + '</option>');
                });
                result.data['model'].map(function(value, key) {
                    isSelected = (value.model == model) ? 'selected' : '';
                    $('.model').append('<option value="' + value.model + '" ' + isSelected + '>' + value.model + '</option>');
                });
                result.data['submodel'].map(function(value, key) {
                    $('.submodel').append('<option value="' + value.submodel + '-' + value.body + '">' + value.submodel + '-' + value.body + '</option>');
                });
            } else {
                result.data.map(function(value, key) {
                    if (changeBy == 'make') {

                        isSelected = (value.year == year) ? 'selected' : '';
                        $('.year').append('<option value="' + value.year + '"' + isSelected + '>' + value.year + '</option>');
                    }
                    if (changeBy == 'year') {
                        isSelected = (value.model == model) ? 'selected' : '';
                        $('.model').append('<option value="' + value.model + '"' + isSelected + '>' + value.model + '</option>');
                    }
                    if (changeBy == 'model') {
                        $('.submodel').append('<option value="' + value.submodel + '-' + value.body + '">' + value.submodel + '-' + value.body + '</option>');
                    }
                });
            }




        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Something Went Wrong!')
            $loading.fadeOut("slow");
        }
    });
}


$('.SearchByVehicleGo').click(function(){

    make = $('.make').val();
    year = $('.year').val();
    model = $('.model').val();
    submodel = $('.submodel').val();


    var data = {
        year: year,
        make: make,
        model: model, 
        submodel: submodel, 
        accesstoken: accesstoken
    } 

    $.ajax({
        url: baseurl + "/api/findVehicle",
        data: data,
        type: "POST", 
        success: function(result) {
            if (result['status'] == false) {
                alert(result['message']);
            }else{

                vehicle = result['data']['vehicle'];
                vehicleid = result['data']['vehicle']['vehicle_id'];

                if(result['status']==true &&  result['data']['offroad'] != ''){
                    offroadid = result['data']['offroad'];
                    loadOffroadView();
                }else{

                    flag = 'searchByVehicle';
                    loadZipcodeView(); 
                }
            } 
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Something Went Wrong!')
            $loading.fadeOut("slow");
        }
    });
})

function loadOffroadView(){
    $('#Offroad-View-Section').html(`

                <div class="modal" id="offroadTypeModal" role="dialog">
                    <div class="modal-dialog tire-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select any one for your vehicle</h4>
                            </div>
                            <div class="modal-body"  >
                                <!-- <div class="col-md-12"> -->
                                    
                                    <div style="text-align: center;">
                                        <div class="btn btn-info select-offroad" data-offroad="levelkit">
                                            <img src="`+baseurl+`/image/lifttype.jpg" >
                                            <br>
                                            <h3 style="color: white !important">Leveling Kit</h3>
                                        </div> 
                                    </div>

                                                       <br>                                 
                                    <div style="text-align: center;">    
                                        <div class="btn btn-info select-offroad" data-offroad="lift">
                                            <img src="`+baseurl+`/image/lifttype.jpg" >
                                            <br>
                                            <h3 style="color: white !important">Lift Kit</h3>
                                        </div>
                                    </div>
                                    <br>
                                    <div style="text-align: center;"> 
                                        <div class="btn btn-info select-offroad" data-offroad="stock">

                                            <img src="`+baseurl+`/image/lifttype.jpg" >
                                            <br>
                                            <h3 style="color: white !important">Stock</h3>
                                        </div>
                                    </div> 
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>


        `);

    $('#offroadTypeModal').modal('show');
}


$(document).on('click','.select-offroad',function(){

    $("#offroadTypeModal").modal('hide');
    
    offroadtype = $(this).data('offroad'); 
    
    if(offroadtype != 'lift'){
        if(offroadtype == 'levelkit'){
            liftsize ='Levelkit'
        }

        flag = 'searchByVehicle';
        loadZipcodeView(); 
    }else{
        var data = {
            offroadid:offroadid,
            accesstoken:accesstoken
        };

        console.log(data);
        $.ajax({
            url: baseurl + "/api/getLiftSizes",
            data: data,
            type: "POST", 
            success: function(result) {
                if (result['status'] == false) {
                    alert(result['message']);
                }else{
                    if(result['status']==true ){
                        console.log(result)
                        loadOffroadSizeView(result['data']);
                    }else{
                        flag = 'searchByVehicle';
                        loadZipcodeView(); 
                    }
                } 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Something Went Wrong!')
                $loading.fadeOut("slow");
            }
        });
    }

});

 

function loadOffroadSizeView(data){

    var loadSizeStr=`
                <div class="modal" id="liftsizeModal" role="dialog">
                    <div class="modal-dialog tire-view">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Please select your vehicle's lift:</h4>
                            </div>
                            <div class="modal-body"> 
    `;

    $.each(data, function(sizekey, size ){
        loadSizeStr+=`
                                    <div style="text-align: center;"> 
                                        <button class="btn btn-info select-liftsize" data-liftsize="`+sizekey+`">

                                            <img src="`+baseurl+`/image/lifttype.jpg" >
                                            <br>
                                            <h3 style="color: white !important">` + size + `</h3>
                                        </button>
                                    </div>
                                    <br>
        `;
    });
    
    loadSizeStr+=`

                            </div>
                        </div>
                    </div>
                </div>
    `;

    $('#Offroad-Size-View-Section').html(loadSizeStr);

    $('#liftsizeModal').modal('show');
}

$(document).on('click','.select-liftsize',function(){

    $("#liftsizeModal").modal('hide');
    liftsize = $(this).data('liftsize');  
    flag = 'searchByVehicle';
    loadZipcodeView(); 
});


function loadZipcodeView(){ 
    if(zipcode ==''){
        $('#liftsizeModal').modal('hide');
        $("#Zipcode-Section").html(`
                    <div class="modal fade" id="Zipcode-Section-Modal" role="dialog">
                        <div class="modal-dialog tire-view">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Zipcode</h4>
                                </div>
                                <div class="modal-body"> 
                                        <div class="form-group has-success has-feedback">
                                            <label class="col-sm-5 control-label" for="inputSuccess">Your Zipcode</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="zipcode-input" name="zipcode" required=""> 
                                            </div>
                                        </div>
                                        <div style="text-align:center;">
                                            <button class="btn btn-info" id="update-zipcode-button" type="button">Continue</button>
                                        </div> 
                                </div>
                            </div>
                        </div>
                    </div>
        `);

        $("#Zipcode-Section-Modal").modal('show');
    }else{
        redirectToList();
    }

}



$(document).on('click','#update-zipcode-button',function(){

    $("#Zipcode-Section-Modal").modal('hide');
        zipcode = $("#zipcode-input").val();
    redirectToList();
});

function redirectToList(){
    window.location.href = "/products?"+
    "make="+make+
    "&year="+year+
    "&model="+model+
    "&submodel="+submodel+
    "&vehicleid="+vehicleid+
    "&offroadid="+offroadid+
    "&offroadtype="+offroadtype+
    "&liftsize="+liftsize+
    "&flag="+flag+
    "&zipcode="+zipcode+
    "&pagename=list";
}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(decodeURIComponent(hash[0]));
        vars[hash[0]] = decodeURIComponent(hash[1]);
    }
    return vars;
}

// function getJsonFromUrl(url) {
//   if(!url) url = location.search;
//   var query = url.substr(1);
//   var result = {};
//   query.split("&").forEach(function(part) {
//     var item = part.split("=");
//     result[item[0]] = decodeURIComponent(item[1]);
//   });
//   return result;
// }


//  Driver / Body change your car 
function getWheelsList() {  
    var data =""; 
    var listType = 'html';
    if(qryData['flag'] == 'searchByVehicle'){
        data={
            flag:'searchByVehicle',
            vehicleid:qryData['vehicleid'],
            zipcode:qryData['zipcode'],
            offroadtype:qryData['offroadtype'],
            liftsize: qryData['liftsize'],
            listType: listType,
            accesstoken: accesstoken
        }

    }

    if(qryData['flag'] == 'searchByWheelSize'){
        data={
            flag:searchByWheelSize, 
            zipcode:zipcode, 
            listType: listType,
            accesstoken: accesstoken,
        }
    }
  
    console.log("Passed Data",data);
    if(qryData['pagename'] == 'list'){
        $.ajax({
            url: baseurl + "/api/getWheels",
            data: data,
            type: "POST",
            success: function(result) {
                console.log(result);

                if (result['status'] == true) {

                    products = result['data']['products'];
                    if(listType == 'html'){
                        listProducts(result['data']);
                    }

                    // $loading.fadeOut("slow");

                } else {

                    // $loading.fadeOut("slow");
                    alert(result['message']);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Something Went Wrong!')
                // $loading.fadeOut("slow");
            }
        });
    }
};


function listProducts(products) {
    console.log('listProducts', products);
    $('#Visualiser-Products-Section').html(products['htmllist']);

    $(".se-pre-con").fadeOut("slow");
}


function getVisualiserModal() {

    var modalStr = `
        <!-- Visualiser Model Start -->
<div class="modal fade" id="VisualiserModal" role="dialog">
    <div class="modal-dialog new_visualiser">
        <div class="modal-content visualiser_content">
            <div class="modal-header visualiser_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="VisualiserLabel">Modal Header</h4>
            </div>
            <div class="modal-body visualiser_body">
                <div class="row main-visualiser-body">
                    <div class="col-sm-12 model-visualiser" id="modal_visualiser">
                        <img id="vehicle-image" class="vehicle_image visualiser_image_responsive" src="new_car.png">
                    </div>
                    <div class="vehicle-wheel">
                        <div class="front_wheel">
                            <img class="front_wheel" src="front_wheel.png" id="visualiser-wheel-front">
                        </div>
                        <div class="back_wheel">
                            <img class="back_wheel" src="front_wheel.png" id="visualiser-wheel-back">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                            <div class="col-sm-4">
                                <h1 class="model-car">Wheel Diameter</h1>
                                <button class="model-button diameter-up" data-id="0">Zoom In</button>
                                <button class="model-button diameter-down" data-id="0">Zoom Out</button>
                            </div> 
            </div>
        </div>
    </div>
</div>

        <!-- Visualiser Model End -->
          `;

    $('#Visualiser-Section').html(modalStr);
}

function getWheelPosition(partno = '') {

 
    var data = { 
        make:qryData['make'],
        model:qryData['model'],
        year:qryData['year'],
        submodel:qryData['submodel'],
        vehicleid:qryData['vehicleid'],
        wheelpartno: partno,
        accesstoken: accesstoken,
    };

    console.log('Object Detection',data);
 
    $.ajax({
        url: baseurl + "/api/WheelByVehicle",
        data: data,
        type: "POST", 
        success: function(result) {


            if (result['status'] == true) {

                allData = result['data'];

                $loading.fadeOut("slow");


                $("#VisualiserModal").modal("show");

                WheelMapping('0')
            } else {

                $loading.fadeOut("slow");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Something Went Wrong!')
            $loading.fadeOut("slow");
        }
    });
}

function WheelMapping(key = '') {
    // console.log(allData);
    boxes = allData['position'];

    $('#vehicle-image').attr('src', allData['carimage']);
    $('#visualiser-wheel-front').attr('src', allData['frontimage']);
    $('#visualiser-wheel-back').attr('src', allData['frontimage']);
    $('#VisualiserLabel').html(allData['vehicle']);

    if (boxes[0][0] < 400) {

        f = boxes[0];

        b = boxes[1];

    } else {

        f = boxes[1];

        b = boxes[0];
    }

    var front = $('#visualiser-wheel-front');
    front.css('left',f[0]-18+'px');
    front.css('top',f[1]-1+'px');

    if (widthAdjusted) {
        var extraWidth = 0;
        if (front.width() - f[2] > 4) {
            extraWidth = (front.width() - f[2]) / 2;
        }
        front.width(front.width() + extraWidth + 'px');
        widthAdjusted = false;
    }


    var back = $('#visualiser-wheel-back');
    back.css('left', b[0] - 11.5 + 'px');
    back.css('top', b[1] + 8.5  + 'px');
}


 
    </script>


    <script src="{{ asset('js/tire_product_search.js') }}"></script>
    <script src="{{ asset('js/wheel_product_search.js') }}"></script>
    <script src="{{ asset('js/wheel_visualiser.js') }}"></script>
    <script src="{{ asset('js/common_search.js') }}"></script>
    <script src="{{ asset('js/popImg.js') }}"></script>
    <!-- <script src="{{ asset('js/opencv/opencv-3.3.1.js') }}" async></script> -->













</body>

</html>
