<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Wheel</title>
    <link rel="stylesheet" href="{{ asset('css/ontheme/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/category-feature.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/lightbox.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/ontheme/otblogstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ontheme/otcountdown.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('css/opencart.css') }}">

    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery/magnific/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery/datetimepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/font-awesome/css/font-awesome.min.css') }}"> @yield('styles')
</head>

<body>
    <main>

        <section>
            <div class="container-fluid home-page">

                @yield('content')

            </div>
        </section>
    </main>
    <!-- Main End -->
    <!-- Javascript Start -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <!-- <script src="{{ asset('js/common.js') }}" ></script>  -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- <script src="{{ asset('js/ontheme/addonScript.js') }}"></script> -->
    <script src="{{ asset('js/ontheme/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/ontheme/jquery.elevatezoom.min.js') }}"></script>
    <script src="{{ asset('js/ontheme/lightbox-2.6.min.js') }}"></script>
    <!-- <script src="{{ asset('js/ontheme/waypoints.min.js') }}" ></script> -->

    <script type="javascript/text" src="{{ asset('js/swiper.jquery.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>

    <script src="{{ asset('js/jquery/magnific/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/jquery/datetimepicker/moment.min.js') }}"></script>
    <script src="{{ asset('js/jquery/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>


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
    <!-- <script type="text/javascript">
        $('#carousel0').swiper({
            mode: 'horizontal',
            autoplay: 3000,
            //pagination: '.carousel0',
            pagination: false,
            paginationClickable: false,
            prevButton: '.swiper-button-prev',
            nextButton: '.swiper-button-next',

            // Default parameters
            slidesPerView: 6,

            // Responsive breakpoints
            breakpoints: {
                // when window width is <= 1200px
                1200: {
                    slidesPerView: 5
                },
                // when window width is <= 991px
                991: {
                    slidesPerView: 4
                },
                // when window width is <= 767px
                767: {
                    slidesPerView: 3
                },
                // when window width is <= 480px
                480: {
                    slidesPerView: 2
                }
            }

        });
    </script> -->
    <script type="text/javascript">
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
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<!--     <script>
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
    </script> -->
</body>

</html>
