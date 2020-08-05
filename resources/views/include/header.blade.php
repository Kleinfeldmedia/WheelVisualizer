
<style type="text/css">
    #header-search .btn-danger {
    background: red !important;
    border: none;
    color: #fff;
    text-transform: none;
    padding: 13px 33px;
    margin: 0;
    height: 44px;
    font-size: 14px;
    line-height: 18px;
    border-radius: 0px !important;
    font-family: Montserrat !important;
    letter-spacing: 0px;
}
</style>
<header>
    <nav id="top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div id="top-links" class="pull-left">
                        <ul class="list-inline">
                            <li class="header-phone pull-left"><a href=""><i class="fa fa-phone"></i><span>{{Setting::get('site_contact','123456789')}}</span></a></li>
                            <li class="header-phone pull-left"><a href=""><i class="fa fa-envelope-o"></i><span>{{Setting::get('site_email','sales@discountedwheelwarehouse.com')}}</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="top-links" class="pull-right">
                        <ul class="list-inline">
                            @if(Auth::user() != null)
                                <li class="header-phone pull-left"><a href="{{url('/dashboard')}}"><i class="fa fa-tachometer" aria-hidden="true"></i><span>My Dashboard</span></a></li>

                                    <ul class="dropdown-menu multi-colum-nav info-nav">
                                        <div class="row">
                                            <div class="col-sm-12 tire-menu-list">
                                                <div class="col-sm-10">
                                                    <div class="vehicle-list">
                                                        <div class="row">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                    
                                <li class="header-phone pull-left">
                                    <form action="{{ url('/logout') }}" method="POST">
                                        {{csrf_field()}}
                                        <button type="submit"><i class="fa fa-sign-out"></i> Sign out</button>
                                    </form>
                                </li>
                            @else
                                <li class="header-phone pull-left"><a href="{{url('/register')}}"><i class="fa fa-user-plus"></i><span>Sign Up</span></a></li>
                                <li class="header-phone pull-left"><a href="{{url('/login')}}"><i class="fa fa-sign-in"></i><span>Sign In</span></a></li>
                                <li class="header-phone pull-left"><a href="{{url('/guest')}}"><i class="fa fa-sign-in"></i><span>Guest Login</span></a></li>
                            @endif
                            <!-- <li class="header-phone pull-left"><a href=""><i class="fa fa-heart"></i><span>Wishlist</span></a></li> -->
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
                    <form class="form" method="POST" action="{{url('/search')}}">
                        {{@csrf_field()}}
                        <div class="search"> 
                            <div id="header-search" class="input-group">
                                <div class="col-sm-4 dropdown" style="border-right: 1px solid Black; padding: 2px ;">
                                    <select required="" class="form-control browser-default custom-select" name="search_for">
                                        <option value="">Select One</option> 
                                        <option value="Tire" {{(base64_decode(@Request::get('for')) == 'Tire')?'selected':''}}>Search for Tire</option> 
                                        <option value="Wheel" {{(base64_decode(@Request::get('for')) == 'Wheel')?'selected':''}}>Search for Wheel</option> 
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="search" value="{{base64_decode(@Request::get('search'))}}" id="header-search-input" placeholder="Type to Search" class="form-control input-lg" />
                                </div>

                                <div class="col-sm-{{(base64_decode(@Request::get('for')))?'2':'4'}}" style="border: 1px; padding: 2px;">
                                    <span class="input-group-btn pull-right"><button type="submit" class="btn btn-default btn-lg header-search-btn"><i class="fa fa-search"></i>Search</button></span>
                                </div>
                                @if(base64_decode(@Request::get('for')))
                                <div class="col-sm-{{(base64_decode(@Request::get('for')))?'2':'0'}}" style="border: 1px; padding: 2px;">
                                    <span class="input-group-btn pull-right"><button type="button" class="btn btn-danger btn-lg header-clear-btn"> Clear</button></span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
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
                <div class="col-sm-8 nav-bar">
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

                                                    <form action="{{url('/setFiltersByProductVehicle')}}"  id="WheelVehicleSearch">
                                                        <input type="hidden" name="flag" value="searchByVehicle">
                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavMake" name="make">
                                                                <option value="">Select Make</option>
                                                                @foreach(getVehicleList('make') as $key => $make)
                                                                <option value="{{$make}}" {{(@\Session::get('user.searchByVehicle')['make'] == $make)?'selected':''}}>{{$make}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavYear" name="year">
                                                                <option value="">Select Year</option>
                                                                @foreach(getVehicleList('year','desc') as $key => $year)
                                                                <option value="{{$year}}" {{(@\Session::get('user.searchByVehicle')['year'] == $year)?'selected':''}}>{{$year}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavModel" name="model">
                                                                <option value="">Select Model</option>
                                                                @foreach(getVehicleList('model') as $key => $model)
                                                                <option value="{{$model}}" {{(@\Session::get('user.searchByVehicle')['model'] == $model)?'selected':''}}>{{$model}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select WheelNavSubmodel" name="submodel">
                                                                <option value="">Select Trim</option>
                                                                @foreach(getVehicleList('submodel') as $key => $submodel) 
                                                                <option value="{{$submodel."-".$key}}" {{(@\Session::get('user.searchByVehicle')['submodel'] == $submodel."-".$key)?'selected':''}}>{{$submodel."-".$key}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                               <!--          <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div> -->
                                                        <!-- <a href="" disabled> -->
                                                            <button type="button" class="btn vehicle-go WheelVehicleSubmit">GO</button>
                                                        <!-- </a> -->
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
                                                                
                                                                @foreach(getWheelList('wheeldiameter') as $key => $wheeldiameter)
                                                                <option value="{{$wheeldiameter}}" {{(@\Session::get('user.searchByWheelSize')['wheeldiameter'] == $wheeldiameter)?'selected':''}}>{{$wheeldiameter}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select ProductWheelWidth" name="wheelwidth">
                                                                <option value="">Select Width</option>
                                                                @foreach(getWheelList('wheelwidth') as $key => $wheelwidth)
                                                                <option value="{{$wheelwidth}}" {{(@\Session::get('user.searchByWheelSize')['wheelwidth'] == $wheelwidth)?'selected':''}}>{{$wheelwidth}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select class="form-control browser-default custom-select BoltPattern" name="boltpattern">
                                                                <option value="">Select BoltPattern</option>
                                                                @foreach(getWheelList('boltpattern') as $key => $boltpattern)
                                                                <option value="{{$boltpattern}}" {{(@\Session::get('user.searchByWheelSize')['boltpattern'] == $boltpattern)?'selected':''}}>{{$boltpattern}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select class="form-control browser-default custom-select MinOffset" name="minoffset">
                                                                <option value="">Select MinOffset</option>
                                                                @foreach(getWheelList('minoffset') as $key => $minoffset)
                                                                <option value="{{$minoffset}}" {{(@\Session::get('user.searchByWheelSize')['minoffset'] == $minoffset)?'selected':''}}>{{$minoffset}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="dropdown">
                                                            <select class="form-control browser-default custom-select MaxOffset" name="maxoffset">
                                                                <option value="">Select MaxOffset</option>
                                                                @foreach(getWheelList('maxoffset') as $key => $maxoffset)
                                                                <option value="{{$maxoffset}}" {{(@\Session::get('user.searchByWheelSize')['maxoffset'] == $maxoffset)?'selected':''}}>{{$maxoffset}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div> -->
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
                                                                @foreach(getVehicleList('make') as $key => $make)
                                                                <option value="{{$make}}" {{(@\Session::get('user.searchByVehicle')['make'] == $make)?'selected':''}}>{{$make}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavYear" name="year">
                                                                <option value="">Select Year</option>
                                                                @foreach(getVehicleList('year','desc') as $key => $year)
                                                                <option value="{{$year}}" {{(@\Session::get('user.searchByVehicle')['year'] == $year)?'selected':''}}>{{$year}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavModel" name="model">
                                                                <option value="">Select Model</option>

                                                                @foreach(getVehicleList('model') as $key => $model)
                                                                <option value="{{$model}}" {{(@\Session::get('user.searchByVehicle')['model'] == $model)?'selected':''}}>{{$model}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavSubmodel" name="submodel">
                                                                <option value="">Select Trim</option>

                                                                @foreach(getVehicleList('submodel') as $key => $submodel) 
                                                                <option value="{{$submodel."-".$key}}" {{(@\Session::get('user.searchByVehicle')['submodel'] == $submodel."-".$key)?'selected':''}}>{{$submodel."-".$key}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                 <!--        <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div> -->

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
                                                                <option value="" >Select Width</option>
                                                                @foreach(getTireList('width') as $key => $width)
                                                                <option value="{{$width}}"  {{(@\Session::get('user.searchByTireSize')['width'] == $width && $width!=0)?'selected':''}}>{{$width}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavProfile" name="profile">
                                                                <option value="">Select Profile</option>
                                                                @foreach(getTireList('profile') as $key => $profile)
                                                                <option value="{{$profile}}"  {{(@\Session::get('user.searchByTireSize')['profile'] == $profile)?'selected':''}}>{{$profile}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="dropdown">
                                                            <select required="" class="form-control browser-default custom-select NavDiameter" name="diameter">
                                                                <option value="">Select Diameter</option>
                                                                @foreach(getTireList('diameter') as $key => $diameter)
                                                                <option value="{{$diameter}}"  {{(@\Session::get('user.searchByTireSize')['diameter'] == $diameter)?'selected':''}}>{{$diameter}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                 <!--        <div class="dropdown">
                                                            <input required="" type="text" class="form-control" name="zip" placeholder="Enter ZIP">
                                                        </div> -->
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

                                                        <div class="col-sm-12 tire-menu tire-two">
                                                            <ul>
                                                                <li><a href="{{url('/tirebrand')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> All</a></li>
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

                            <li class="dropdown dropdown-tire">
                                <!-- <a href="{{url('/tirelist')}}">DISCOUNT TIRES <span class="caret"></span></a> -->
                                <a href="{{url('/informations')}}" class="dropdown-toggle" data-toggle="dropdown">INFORMATION <span class="caret"></span></a>
                                <ul class="dropdown-menu multi-colum-nav info-nav">
                                    <div class="row">
                                        <div class="col-sm-12 tire-menu-list">
                                            <div class="col-sm-10">
                                                <div class="vehicle-list">
                                                    <div class="row">

                                                        <div class="col-sm-12 tire-menu tire-two">
                                                            <ul>
                                                                <li><a href="{{url('/orderstatus')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Order Status</a></li> 
                                                                <li><a href="{{url('/wheelproducts')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Wheel Pages</a></li>
                                                                <li><a href="{{url('/tirelist')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tire Pages</a></li>
                                                                <!-- <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Classic Wheels</a></li> -->
                                                                <li><a href="{{url('/wheels')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Vehicle Gallery</a></li>
                                                                <li><a href="{{url('/videos')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Videos</a></li>
                                                                <li><a href="{{url('/bloglist')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Blog</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> 3-Piece Wheels</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> 8-Lug Wheels</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Black Wheels</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Dually Wheels</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tuner Wheels</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Off Road Wheels</a></li>
                                                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Custom Grilles</a></li>
                                                                <!-- <li><a href="{{url('/boltpatterns')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Bolt Patterns</a></li> -->
                                                                <li><a class="sizelinks" data-category="inch" data-value="17" ><i class="fa fa-angle-double-right" aria-hidden="true"></i> 17 inch Specials</a></li>
                                                                <li><a class="sizelinks" data-category="inch" data-value="18" ><i class="fa fa-angle-double-right" aria-hidden="true"></i> 18 inch Specials</a></li>
                                                                <li><a class="sizelinks" data-category="inch" data-value="20" ><i class="fa fa-angle-double-right" aria-hidden="true"></i> 20 inch Specials</a></li>
                                                                <li><a class="sizelinks" data-category="inch" data-value="22" ><i class="fa fa-angle-double-right" aria-hidden="true"></i> 22 inch Specials</a></li>
                                                                <li><a class="sizelinks" data-category="inch" data-value="24" ><i class="fa fa-angle-double-right" aria-hidden="true"></i> 24 inch Specials</a></li>
                                                                <li><a class="sizelinks" data-category="inch" data-value="26" ><i class="fa fa-angle-double-right" aria-hidden="true"></i> 26 inch Specials</a></li>
                                                                <!-- <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Closeouts</a></li> -->
                                                                <!-- <li><a href="{{url('/lipsizes')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Lip Sizes</a></li> -->
                                                                <!-- <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Wheel Search</a></li> -->
                                                                <!-- <li><a href="{{url('/wheelconfig')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Wheel Configurator</a></li> -->
                                                                <!-- <li><a href="{{url('/traction')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Traction</a></li> -->
                                                                <li><a href="{{url('/informations/shippinginfo')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Shipping Info</a></li>
                                                                <li><a href="{{url('/informations/feedback')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Feedback</a></li>
                                                                <li><a href="{{url('/informations/privacypolicy')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Privacy Policy</a></li>
                                                                <li><a href="{{url('/informations/returnpolicy')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Return Policy</a></li>
                                                                <li><a href="{{url('/informations')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> More Informations... </a></li>
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
                            <li class=""><a href="{{url('/wheels')}}">WHEEL VISUALIZER</a></li>
                            <!-- <li class=""><a href="{{url('/rimfinancing')}}">RIMS FINANCING</a></li> -->
                            <!-- <li class=""><a href="{{url('/aboutus')}}">ABOUT</a></li> -->
                            <!-- <li class=""><a href="{{url('/contactus')}}">CONTACT</a></li> -->


                            @foreach(getCMSPages('TopNavbar') as $key => $page)
                                <li class=""><a href="{{url('/cmspage')}}/{{$page->routename}}">{{$page->title}}</a></li>
                            @endforeach
                            <!-- <li class=""><a href="">ENQUIRY</a></li> -->

                        </ul>
                    </div>
                </div>
                 
                <div class="col-sm-2">
                    <a href="{{url('/CartItems')}}" class="btn btn-inverse btn-block btn-lg"><i class="fa fa-shopping-cart"></i>
                        <span class="cart-heading">Cart</span>
                        <span id="cart-total">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</header>

@section('header_scripts')
<script>
    window.onscroll = function() {
        myFunction()
    };
    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        // if (window.pageYOffset > sticky)
        if ($(document).scrollTop() > 130) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>

@endsection
