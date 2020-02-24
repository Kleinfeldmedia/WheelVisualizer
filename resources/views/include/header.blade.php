<header>
    <nav id="top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div id="top-links" class="pull-left">
                        <ul class="list-inline">
                            <li class="header-phone pull-left"><a href=""><i class="fa fa-phone"></i><span>123456789</span></a></li>
                            <li class="header-phone pull-left"><a href=""><i class="fa fa-envelope-o"></i><span>sales@discountedwheelwarehouse.com</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="top-links" class="pull-right">
                        <ul class="list-inline">
                            @if(@Auth::user()=='')
                            <li class="header-phone pull-left"><a href="{{url('/login')}}"><i class="fa fa-user-plus"></i><span>Sign Up</span></a></li>
                            <li class="header-phone pull-left"><a href="{{url('/login')}}"><i class="fa fa-sign-in"></i><span>Sign In</span></a></li>
                            @else
                            <li class="header-phone pull-left">
                                <form action="{{ url('/logout') }}" method="POST">
                                    {{csrf_field()}}
                                    <button type="submit"><i class="fa fa-sign-out"></i> Sign out</button>
                                </form>
                            </li>
                            @endif
                            <li class="header-phone pull-left"><a href=""><i class="fa fa-heart"></i><span>Wishlist</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="full-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 logo">
                    <div class="header">
                        <div id="logo">
                            <a href="{{url('/')}}"><img src="{{url('image/Logo/New-Logo.png')}}" title="Discounted Wheel Warehouse" alt="Discounted Wheel Warehouse" class="img-responsive" /></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 search-bar">
                    <div class="search">
                        <div id="header-search" class="input-group">
                            <input type="text" name="search" value="{{json_decode(base64_decode(@Request::get('search')))}}" id="header-search-input" placeholder="Search" class="form-control input-lg" />
                            <span class="input-group-btn"><button type="button" class="btn btn-default btn-lg header-search-btn"><i class="fa fa-search"></i>Search</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myHeader" class="new-navbar">

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="row new-nav">
                <div class="col-sm-10 nav-bar">
                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav navbar">
                            <li class="dropdown dropdown-nav">
                                <!-- <a title="WHEELS" href="{{route('wheelproducts')}}">DISCOUNT WHEELS <span class="caret"></span></a> -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">DISCOUNT WHEELS <span class="caret"></span></a>
                                <ul class="dropdown-menu nav-dropdown">

                                    <!-- New Menu Start-->
                                    <div class="row tire-nav">
                                        <div class="col-sm-12">
                                            <h1 class="car-truck-head">Shop by Passenger Car and Light Truck
                                                <img src="{{url('image/car.svg')}}" class="moving-car">
                                                <img src="{{url('image/suv.svg')}}" class="moving-truck"></h1>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-2 shop-vehicle-head">
                                                <h1>Shop By Vehicle</h1>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="vehicle-list">

                                                    <form action="{{url('/setFiltersByProductVehicle')}}">
                                                        <input type="hidden" name="flag" value="searchByVehicle">
                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavMake" name="make">
                                                                <option value="">Select Make</option>
                                                                @foreach(getVehicleMakeList() as $key => $make)
                                                                <option value="{{$make}}">{{$make}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavYear" name="year">
                                                                <option value="">Year</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavModel" name="model">
                                                                <option value="">Model</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavSubmodel" name="submodel">
                                                                <option value="">Trim</option>

                                                            </select>
                                                        </div>
                                                        <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div>
                                                        <a href="">
                                                            <button type="submit" class="btn vehicle-go">GO</button>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-2 shop-vehicle-head">
                                                <h1>Shop By Wheel Size</h1>
                                            </div>
                                            <div class="col-sm-10">
                                                <form action="{{url('/setFiltersByProductWheelSize')}}">
                                                    <input type="hidden" name="flag" value="searchByWheelSize">
                                                    <div class="vehicle-list">
                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select ProductWheelDiameter" name="wheeldiameter">
                                                                <option value="">Select Diameter</option>
                                                                @foreach(getWheelDiameterList() as $key => $diameter)
                                                                <option value="{{$diameter}}">{{$diameter}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select ProductWheelWidth" name="wheelwidth">
                                                                <option value="">Select Width</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select class="form-control browser-default custom-select BoltPattern" name="boltpattern">
                                                                <option value="">Select BoltPattern</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select class="form-control browser-default custom-select MinOffset" name="minoffset">
                                                                <option value="">Select MinOffset</option>
                                                            </select>
                                                        </div>
                                                        <div class="dropdown">
                                                            <select class="form-control browser-default custom-select MaxOffset" name="maxoffset">
                                                                <option value="">Select MaxOffset</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div>
                                                        <a href="">
                                                            <button type="submit" class="btn vehicle-go">GO</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12 tire-menu-list">
                                            <div class="col-sm-2 shop-vehicle-head">
                                                <h1>Shop By Brand</h1>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="vehicle-list">
                                                    <div class="row">

                                                        <div class="col-sm-12 tire-menu">

                                                            <ul class="tire-dropdown-menu">
                                                                <li><a title="ALL" href="{{route('wheelproducts')}}">ALL</a></li>

                                                                @forelse(getWheelBrandList() as $brand)
                                                                <li><a title="{{$brand}}" href="{{route('wheelproducts')}}?brand={{base64_encode(json_encode(array($brand)))}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{$brand}}</a></li>
                                                                @empty @endforelse
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- New Menu End -->

                                </ul>
                            </li>

                            <!-- New Nav Start -->
                            <li class="dropdown dropdown-tire">
                                <!-- <a href="{{url('/tirelist')}}">DISCOUNT TIRES <span class="caret"></span></a> -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">DISCOUNT TIRES <span class="caret"></span></a>
                                <ul class="dropdown-menu multi-colum-nav">
                                    <!-- New Menu Start-->
                                    <div class="row tire-nav">
                                        <div class="col-sm-12">
                                            <h1 class="car-truck-head">Shop by Passenger Car and Light Truck
                                                <img src="{{url('image/car.svg')}}" class="moving-car">
                                                <img src="{{url('image/suv.svg')}}" class="moving-truck"></h1>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-2 shop-vehicle-head">
                                                <h1>Shop By Vehicle</h1>
                                            </div>
                                            <div class="col-sm-10">
                                                <form action="{{url('/setFiltersByVehicle')}}">
                                                    <div class="vehicle-list">
                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavMake" name="make">
                                                                <option value="">Select Make</option>
                                                                @foreach(getVehicleMakeList() as $key => $make)
                                                                <option value="{{$make}}">{{$make}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavYear" name="year">
                                                                <option value="">Year</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavModel" name="model">
                                                                <option value="">Model</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavSubmodel" name="submodel">
                                                                <option value="">Trim</option>

                                                            </select>
                                                        </div>
                                                        <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div>

                                                        <a href="">
                                                            <button type="submit" class="btn vehicle-go">GO</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-2 shop-vehicle-head">
                                                <h1>Shop By Tire Size</h1>
                                            </div>
                                            <div class="col-sm-10">
                                                <form action="{{url('/setFiltersByTire')}}">
                                                    <div class="vehicle-list">
                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavWidth" name="width">
                                                                <option value="">Select Width</option>
                                                                @foreach(getTireWidthList() as $key => $tire)
                                                                <option value="{{$tire}}">{{$tire}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavProfile" name="profile">
                                                                <option value="">Select Profile</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavDiameter" name="diameter">
                                                                <option value="">Select Diameter</option>
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div>
                                                        <a href="">
                                                            <button type="submit" class="btn vehicle-go">GO</button>
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12 tire-menu-list">
                                            <div class="col-sm-2 shop-vehicle-head">
                                                <h1>Shop By Brand</h1>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="vehicle-list">
                                                    <div class="row">

                                                        <div class="col-sm-12 tire-menu">
                                                            <ul>
                                                                @foreach(getTireBrandList() as $key => $tirebrand)
                                                                <li><a href="{{url('/tirebrand')}}/{{base64_encode($tirebrand)}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{$tirebrand}}</a></li>
                                                                @endforeach
                                                            </ul>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- New Menu End -->

                                </ul>
                            </li>
                            <!-- New Nav End -->

                            <li class=""><a href="">INFORMATION</a></li>
                            <li class=""><a href="">RIMS FINANCING</a></li>
                            <li class=""><a href="{{url('/wheels')}}">WHEEL VISUALIZER</a></li>
                            <li class=""><a href="">ABOUT</a></li>
                            <li class=""><a href="">CONTACT</a></li>
                            <li class=""><a href="">ENQUIRY</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-inverse btn-block btn-lg"><i class="fa fa-shopping-cart"></i>
                        <span class="cart-heading">Cart</span>
                        <span id="cart-total">0</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</header>

<!-- New Fixed Nav Start -->

<script>
    window.onscroll = function() {
        myFunction()
    };
    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        // if (window.pageYOffset > sticky)
        if ($(document).scrollTop() > 123) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

</script>
<!-- New Fixed Nav End -->
