 
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

    var accesstoken= "{{@$request->accesstoken?:'ZDJWaU5pNTJkR1J1Y3k1dVpYUT0='}}"
    
    </script>

    <script src="http://web9.vtdns.net/js/wheel-raw-api.js"></script> 


    <script src="{{ asset('js/tire_product_search.js') }}"></script>
    <script src="{{ asset('js/wheel_product_search.js') }}"></script>
    <script src="{{ asset('js/wheel_visualiser.js') }}"></script>
    <script src="{{ asset('js/common_search.js') }}"></script>
    <script src="{{ asset('js/popImg.js') }}"></script>
    <!-- <script src="{{ asset('js/opencv/opencv-3.3.1.js') }}" async></script> -->

</body>

</html>
