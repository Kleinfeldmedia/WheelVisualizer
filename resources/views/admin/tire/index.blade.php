@extends('admin.layouts.app')

@section('content')
<style type="text/css">
    .req {
        color: red;
    }

    .edit_modal {
        margin: 6%;
        padding: 20px;
    }
    td.scrollable {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: auto !important;
    }



.upload-csv{
    float: right;
    /* position: absolute; */
    top: 20px;
    right: 35px;
    background: #ecb23d !important;
    padding: 6px 20px;
    color: #fff !important;
    border-radius: 4px;
    cursor: pointer;
    font-family: Montserrat !important;
    font-size: 12px !important;
}
.upload-csv>a{
    color: white;
}



</style>

<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap drp-lst">
                    <h4>List of Tires</h4>
                    <div style="text-align:right;padding-bottom: 20px">
                        
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Product</button>
                        
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#csvModal">Upload CSV </button>
                    
                    <a  class="btn btn-info"  href="{{url('admin/exportTable')}}?module=Tire">Export CSV </a>
                    
                    </div>
                    <div class="asset-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <!-- <th>Part No</th> -->
                                    <th>Title</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Image</th>
                                    <!-- <th>Tire Size</th>
                                    <th>Tire Width</th>
                                    <th>Tire Profile</th>
                                    <th>Tire Diameter</th>
                                    <th>Speed Rating</th>
                                    <th>Load Index</th>
                                    <th>PLY</th>
                                    <th>UTQG</th>
                                    <th>Price</th>
                                    <th>Available Quantity</th> -->
                                    <th>Meta Desc</th>
                                    <!-- <th>Desc</th> -->
                                    <th> Actions</th>
                                </tr>
                            </thead>
                            <?php $i=1; ?>
                            @forelse(@$tires as $key => $tire)
                            <?php $tire = (object)$tire; ?>
                            <tr>
                                <td>{{@$i++}}</td>
                                <td>{{@$tire->prodtitle}}</td>
                                <td>{{@$tire->prodbrand}}</td>
                                <td>{{@$tire->prodmodel}}</td>
                                <td><img class="wheelImage" src="{{ViewTireImage(@$tire->prodimage)}}" width="100px" height="100px"></td>
                               <!--  <td>{{@$tire->tiresize}}</td>
                                <td>{{@$tire->tirewidth?:'-'}}</td>
                                <td>{{@$tire->tireprofile?:'-'}}</td>
                                <td>{{@$tire->tirediameter?:'-'}}</td>
                                <td>{{@$tire->speedrating?:'-'}}</td>
                                <td>{{@$tire->loadindex?:'-'}}</td>
                                <td>{{@$tire->ply?:'-'}}</td>
                                <td>{{@$tire->utqg?:'-'}}</td>
                                <td>{{@$tire->price?:'-'}}</td>
                                <td>{{@$tire->qtyavail?:'-'}}</td> -->
                                <td width="30%"><?=@$tire->prodmetadesc?></td>
                                <!-- <td width="30%"><?=@$tire->proddesc?></td> -->
                                <td>  
                                    <a class="btn btn-default" href="{{url('/admin/tire')}}/{{base64_encode(@$tire->id)}}/model"><i class="fa fa-eye" aria-hidden="true"></i> View Models</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Tires found</td>
                            </tr>
                            @endforelse
                        </table>

                        {{$tires->appends(['diameter' => @Request::get('diameter'),'width' => @Request::get('width'),'brand' => @Request::get('brand'),'car_id' => @Request::get('car_id'),'page' => @Request::get('page')])->links()}}
                    </div>

                    <!--  New Model Start-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog admin-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tire Information</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- New Model Content Start -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="product-payment-inner-st">
                                            <ul id="myTabedu1" class="tab-review-design">
                                                <li class="active"><a href="#description2">Basic Details</a></li>
                                            </ul>
                                            <div id="myTabContent" class="tab-content custom-product-edit">
                                                <div class="product-tab-list tab-pane fade active in" id="description2">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="review-content-section">
                                                                <div id="dropzone1" class="pro-ad">

                                                                    <form action="{{url('/admin/tire/')}}" class="dropzone dropzone-custom needsclick add-professors dz-clickable" id="demo1-upload" method="POST" enctype="multipart/form-data">
                                                                        {{@csrf_field()}}
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="brand">Tire Brand <span class="req">*</span></label>
                                                                                    <select class="form-control select2 Brand" name="prodbrand" required="">
                                                                                        <option value="">Select Brand</option>
                                                                                        @foreach(getTireBrandList() as $brand)
                                                                                        <option value="{{$brand}}">{{$brand}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                               <div class="form-group">
                                                                                    <label for="prodmodel">Product Model <span class="req">*</span></label>
                                                                                    <input type="text" name="prodmodel" class="form-control" placeholder="Product Model" required="" value="{{old('prodmodel')}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="prodtitle">Product title <span class="req">*</span></label>
                                                                                    <input type="text" name="prodtitle" class="form-control" placeholder="Product title" required="" value="{{old('prodtitle')}}">
                                                                                </div>
                                                                            </div>             
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="detailtitle">Detailed Title  </label>
                                                                                    <input type="text" name="detailtitle" class="form-control" placeholder="Detailed Title" value="{{old('detailtitle')}}"  >
                                                                                </div>
                                                                            </div>    
                                                                        </div>   
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <label for="prodimage">Product Image <span class="req">*</span></label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="prodimage" class="dropify form-control-file" aria-describedby="fileHelp" required="" data-default-file="{{old('prodimage')}}">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="prodlandingdesc">Product Landing Description </label>
                                                                                    <textarea class="form-control" name="prodlandingdesc" >{{old('prodlandingdesc')}}</textarea> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="proddesc">Product Description </label>
                                                                                    <textarea class="form-control" name="proddesc" >{{old('proddesc')}}</textarea> 
                                                                                </div>
                                                                            </div>                                                     
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="prodmetadesc">Product Meta Description </label>
                                                                                    <textarea class="form-control" name="prodmetadesc" >{{old('prodmetadesc')}}</textarea> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="partno">Part Number <span class="req">*</span></label>
                                                                                    <input type="text" name="partno" class="form-control" placeholder="Part Number" value="{{old('partno')}}" required="">
                                                                                </div>
                                                                            </div>   

                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="partno_old"> Old Partnumber  </label>
                                                                                    <input type="text" name="partno_old" class="form-control" placeholder="Old Partnumber" value="{{old('partno_old')}}"  >
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="qtyavail">Quantity Available  <span class="req">*</span></label>
                                                                                    <input type="text" name="qtyavail" class="form-control" placeholder="Quantity Available" value="{{old('qtyavail')}}"  required="">
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="tirediameter">Tire Diameter <span class="req">*</span></label>
                                                                                    <input type="number" name="tirediameter" class="form-control" placeholder="Diameter" value="{{old('tirediameter')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="tirewidth">Tire Width <span class="req">*</span></label>
                                                                                    <input type="number" name="tirewidth" class="form-control" placeholder="Width " value="{{old('tirewidth')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="tireprofile">Tire Profile <span class="req">*</span></label>
                                                                                    <input type="number" name="tirewidth" class="form-control" placeholder="Profile " value="{{old('tirewidth')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="tiresize">Tire Size <span class="req">*</span></label>
                                                                                    <input type="text" name="tiresize" class="form-control" placeholder="Size" value="{{old('tiresize')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="speedrating">SpeedRating </label>
                                                                                    <input type="text" name="speedrating" class="form-control" placeholder="Speed Rating " value="{{old('speedrating')}}" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="loadindex">Loadindex  </label>
                                                                                    <input type="text" name="loadindex" class="form-control" placeholder="Load Index " value="{{old('loadindex')}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row"> 

                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="ply">Ply</label>
                                                                                    <input type="text" name="ply" class="form-control" placeholder="Ply" value="{{old('ply')}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="utqg">UTQG</label>
                                                                                    <input type="text" name="utqg" class="form-control" placeholder="UTQG" value="{{old('utqg')}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="warranty">Warranty  </label>
                                                                                    <input type="text" name="warranty" class="form-control" placeholder="Warranty " value="{{old('warranty')}}" >
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="row"> 
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <label for="lt"> LT</label> 
                                                                                    <input type="text" step="any" name="lt" class="form-control" placeholder="LT ?" value="{{old('lt')}}" >
                                                                            </div> 
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <label for="xl"> XL</label> 
                                                                                    <input type="text" step="any" name="xl" class="form-control" placeholder="XL ?" value="{{old('xl')}}" >
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <label for="prodsortcode"> Product Sort Code</label> 
                                                                                    <input type="text" step="any" name="prodsortcode" class="form-control" placeholder="Product Sort Code " value="{{old('prodsortcode')}}" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="weight">Weight <span class="req">*</span> </label>
                                                                                    <input type="number" step="any" name="weight" class="form-control" placeholder="Weight" value="{{old('weight')}}" required="">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="length">Length <span class="req">*</span></label>
                                                                                    <input type="number" step="any" name="length" class="form-control" placeholder="Length" value="{{old('length')}}" required="">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="width">Width <span class="req">*</span></label>
                                                                                    <input type="number" step="any" name="width" class="form-control" placeholder="width" value="{{old('width')}}" required="">
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="height">Height <span class="req">*</span></label>
                                                                                    <input type="number" step="any" name="height" class="form-control" placeholder="Height" value="{{old('height')}}" required="">
                                                                                </div>
                                                                            </div>  
                                                                        </div>  
                                                                        <br>
                                                                        <div class="row">

                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="vehicle_type">Vehicle Type</label>
                                                                                    <select class="form-control select2" name="vehicle_type">
                                                                                        <option value="">Select One</option>
                                                                                        <option value="Passenger">Passenger</option>
                                                                                        <option value="Light Truck/SUV">Light Truck/SUV</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="detaildesctype">Detail Description  Type</label>
                                                                                    <select class="form-control select2" name="detaildesctype">
                                                                                        <option value="">Select One</option>
                                                                                        <option value="Passenger"> Passenger </option>
                                                                                        <option value="LT/SUV"> LT/SUV </option>
                                                                                        <option value="All-Terrain"> All-Terrain </option>
                                                                                        <option value="Commercial"> Commercial </option>
                                                                                        <option value="Performance"> Performance </option>
                                                                                        <option value="Competition"> Competition </option>
                                                                                        <option value="MudTerrain"> MudTerrain </option>
                                                                                        <option value="Winter"> Winter </option>
                                                                                        <option value="Highway"> Highway </option>
                                                                                        <option value="Summer"> Summer </option>
                                                                                        <option value="UHP"> UHP </option>
                                                                                        <option value="CUV/SUV"> CUV/SUV </option>
                                                                                        <option value="SUV/CUV"> SUV/CUV </option>
                                                                                        <option value="All-Weather"> All-Weather </option>
                                                                                        <option value="Trailer"> Trailer </option>
                                                                                        <option value="SUV"> SUV </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="detaildescfeatures">Detail Description Features</label>
                                                                                    <textarea class="form-control" name="detaildescfeatures" >{{old('detaildescfeatures')}}</textarea> 
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="detaildesc">Detail Description</label>
                                                                                    <textarea class="form-control" name="detaildesc" >{{old('detaildesc')}}</textarea> 
                                                                                </div>
                                                                            </div>   
                                                                        </div> 
                                                                        <br> 
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#pricedetails">Price Details</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="price">Price <span class="req">*</span></label>
                                                                                    <input type="number" step="any" name="price" class="form-control" placeholder="Price" value="{{old('price')}}" required="">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="price2">Price 2</label>
                                                                                    <input type="number" step="any" name="price2" class="form-control" placeholder="Price 2" value="{{old('price2')}}" >
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="cost">Cost</label>
                                                                                    <input type="number" step="any" name="cost" class="form-control" placeholder="Cost" value="{{old('cost')}}" >
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="price">Rate</label>
                                                                                    <input type="number" step="any" name="price" class="form-control" placeholder="Price" value="{{old('price')}}" >
                                                                                </div>
                                                                            </div>  
                                                                        </div>   
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="originalprice">Original Price <span class="req">*</span></label>
                                                                                    <input type="number" step="any" name="originalprice" class="form-control" placeholder="Original Price" value="{{old('originalprice')}}" required="">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="yousave">You Save</label>
                                                                                    <input type="number" step="any" name="yousave" class="form-control" placeholder="Your Saved Amount" value="{{old('yousave')}}" >
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="set_amount">Set Amount</label>
                                                                                    <input type="number" step="any" name="set_amount" class="form-control" placeholder="Set Amount" value="{{old('set_amount')}}" >
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                        <br> 
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#saledetails">Sale Details</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="saleprice">Sale Price <span class="req">*</span> </label>
                                                                                    <input type="number" step="any" name="saleprice" class="form-control" placeholder="Sale Price" value="{{old('saleprice')}}" required="">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="saletype">Sale Type</label>
                                                                                    
                                                                                    <input type="number" step="any" name="saletype" class="form-control" placeholder="Sale Type" value="{{old('saletype')}}" >
                                                                                </div>
                                                                            </div>    
                                                                            <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="cost">Cost</label>
                                                                                    <input type="number" step="any" name="cost" class="form-control" placeholder="Cost" value="{{old('cost')}}"  >
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="price">Rate</label>
                                                                                    <input type="number" step="any" name="price" class="form-control" placeholder="Price" value="{{old('price')}}"  >
                                                                                </div>
                                                                            </div>   -->
                                                                        </div>  
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#vendordetails">Vendor Details</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="dropshipper">Dropshipper  </label>
                                                                                    <input type="text" name="dropshipper" class="form-control" placeholder="dropshipper" value="{{old('dropshipper')}}">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="dropshipper2">Dropshipper 2  </label>
                                                                                    <input type="text" name="dropshipper2" class="form-control" placeholder="dropshipper2" value="{{old('dropshipper2')}}">
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="vendorpartno">Vendor Partnumber  </label>
                                                                                    <input type="text" name="vendorpartno" class="form-control" placeholder="vendorpartno" value="{{old('vendorpartno')}}">
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="vendorpartno2">Vendor Partnumber2  </label>
                                                                                    <input type="text" name="vendorpartno2" class="form-control" placeholder="vendorpartno2" value="{{old('vendorpartno2')}}">
                                                                                </div>
                                                                            </div>  
                                                                        </div>   
                                                                        <br>
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#badgeimages">Badge Images</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                 <label for="badge1">Badge Image 1  </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="badge1" class="dropify form-control-file" aria-describedby="fileHelp"   data-default-file="{{old('badge1')}}">
                                                                            </div>    
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                 <label for="badge2">Badge Image 2 </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="badge2" class="dropify form-control-file" aria-describedby="fileHelp"   data-default-file="{{old('badge2')}}">
                                                                            </div>    
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                 <label for="badge3">Badge Image 3 </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="badge3" class="dropify form-control-file" aria-describedby="fileHelp"   data-default-file="{{old('badge3')}}">
                                                                            </div>    
                                                                        </div>  
                                                                        <br>
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#badgeimages">Product Images</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                 <label for="prodimage1">Product Image 1  </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="prodimage1" class="dropify form-control-file" aria-describedby="fileHelp"   data-default-file="{{old('prodimage1')}}">
                                                                            </div>    
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                 <label for="prodimage2">Product Image 2 </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="prodimage2" class="dropify form-control-file" aria-describedby="fileHelp"   data-default-file="{{old('prodimage2')}}">
                                                                            </div>    
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                 <label for="prodimage3">Product Image 3 </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="prodimage3" class="dropify form-control-file" aria-describedby="fileHelp"   data-default-file="{{old('prodimage3')}}">
                                                                            </div>    
                                                                        </div> 
                                                                        <br>
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#benefitsdetails">Benefits Details</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="benefits1">Benefit 1 Description </label>
                                                                                    <textarea class="form-control" name="benefits1" >{{old('benefits1')}}</textarea> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <label for="benefitsimage1">Benefit 1 Image</label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="benefitsimage1" class="dropify form-control-file" aria-describedby="fileHelp" data-default-file="{{old('benefitsimage1')}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="benefits2">Benefit 2 Description </label>
                                                                                    <textarea class="form-control" name="benefits2" >{{old('benefits2')}}</textarea> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <label for="benefitsimage2">Benefit 2 Image</label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="benefitsimage2" class="dropify form-control-file" aria-describedby="fileHelp" data-default-file="{{old('benefitsimage2')}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="benefits3">Benefit 3 Description </label>
                                                                                    <textarea class="form-control" name="benefits3" >{{old('benefits3')}}</textarea> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <label for="benefitsimage3">Benefit 3 Image</label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="benefitsimage3" class="dropify form-control-file" aria-describedby="fileHelp" data-default-file="{{old('benefitsimage3')}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="benefits4">Benefit 4 Description </label>
                                                                                    <textarea class="form-control" name="benefits4" >{{old('benefits4')}}</textarea> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <label for="benefitsimage4">Benefit 4 Image</label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="benefitsimage4" class="dropify form-control-file" aria-describedby="fileHelp" data-default-file="{{old('benefitsimage4')}}">
                                                                            </div>
                                                                        </div>

                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#benefitsdetails">Performance Ratings Details</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="dry_performance">Dry Handling / Dry Traction/ Dry Performance</label>
                                                                                    <input type="number" step="any" name="dry_performance" class="form-control" placeholder="Dry Handling / Dry Traction/ Dry Performance" value="{{old('dry_performance')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="wet_performance">Wet Braking/ Wet Traction/ Wet Performance</label>
                                                                                    <input type="number" step="any" name="wet_performance" class="form-control" placeholder="Wet Braking/ Wet Traction/ Wet Performance" value="{{old('wet_performance')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="mileage_performance">Tread Life/ Mileage/ Wear </label>
                                                                                    <input type="number" step="any" name="mileage_performance" class="form-control" placeholder="Tread Life/ Mileage/ Wear" value="{{old('mileage_performance')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="ride_comfort">Ride Comfort </label>
                                                                                    <input type="number" step="any" name="ride_comfort" class="form-control" placeholder="Ride Comfort" value="{{old('ride_comfort')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="quiet_ride">Quiet Ride/ Noise Comfort/ Quietness</label>
                                                                                    <input type="number" step="any" name="quiet_ride" class="form-control" placeholder="Quiet Ride/ Noise Comfort/ Quietness" value="{{old('quiet_ride')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="winter_performance">Winter Performance/ Snow Traction/ Snow </label>
                                                                                    <input type="number" step="any" name="winter_performance" class="form-control" placeholder="Winter Performance/ Snow Traction/ Snow " value="{{old('winter_performance')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="fuel_efficiency">Fuel Efficiency / Eco </label>
                                                                                    <input type="number" step="any" name="fuel_efficiency" class="form-control" placeholder="Fuel Efficiency / Eco" value="{{old('fuel_efficiency')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="braking">Braking </label>
                                                                                    <input type="number" step="any" name="braking" class="form-control" placeholder="Braking" value="{{old('braking')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="responsiveness">Responsiveness</label>
                                                                                    <input type="number" step="any" name="responsiveness" class="form-control" placeholder="Responsiveness" value="{{old('responsiveness')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="sport">Sport</label>
                                                                                    <input type="number" step="any" name="sport" class="form-control" placeholder="Sport " value="{{old('sport')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="off_road">Off Road</label>
                                                                                    <input type="number" step="any" name="off_road" class="form-control" placeholder="Off Road" value="{{old('off_road')}}"  >
                                                                                </div>
                                                                            </div>   
                                                                        </div> 
                                                                        <br>
                                                                        <ul id="myTabedu1" class="tab-review-design">
                                                                            <li class="active"><a href="#youtubelinks">Youtube Links</a></li>
                                                                        </ul>
                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="youtube1">Video 1</label>
                                                                                    <input type="text" step="any" name="youtube1" class="form-control" placeholder="Embedded URL" value="{{old('youtube1')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="youtube2">Video 2</label>
                                                                                    <input type="text" step="any" name="youtube2" class="form-control" placeholder="Embedded URL" value="{{old('youtube2')}}"  >
                                                                                </div>
                                                                            </div>  
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="youtube3">Video 3</label>
                                                                                    <input type="text" step="any" name="youtube3" class="form-control" placeholder="Embedded URL" value="{{old('youtube3')}}"  >
                                                                                </div>
                                                                            </div> 
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="youtube4">Video 4</label>
                                                                                    <input type="text" step="any" name="youtube4" class="form-control" placeholder="Embedded URL" value="{{old('youtube4')}}"  >
                                                                                </div>
                                                                            </div>    
                                                                        </div> 
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="payment-adress">
                                                                                    <input type="submit" class="btn btn-primary waves-effect waves-light" value="Submit">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- New Model Content End -->
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--New Model End  -->

                    <!--  New Model Start-->
                    <div class="modal fade" id="csvModal" role="dialog">
                        <div class="modal-dialog admin-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Upload CSV File</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- New Model Content Start -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="product-payment-inner-st"> 
                                            <div id="myTabContent" class="tab-content custom-product-edit">
                                                <div class="product-tab-list tab-pane fade active in" id="description2">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="review-content-section">
                                                                <div id="dropzone1" class="pro-ad">

                                                                    <form action="{{url('/admin/tire/uploadcsv')}}" class="dropzone dropzone-custom needsclick add-professors dz-clickable" id="demo1-upload" method="POST" enctype="multipart/form-data">
                                                                        {{@csrf_field()}} 
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <label for="tireuploadedfile">CSV Formated File <span class="req">*</span></label>
                                                                                <br>
                                                                                <input type="file"  name="tireuploadedfile"  class="dropify form-control-file" aria-describedby="fileHelp" required="">
                                                                            </div> 
                                                                        </div>
                                                                        <br>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="payment-adress">
                                                                                    <input type="submit" class="btn btn-primary waves-effect waves-light" value="Submit">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- New Model Content End -->
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--New Model End  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
    $(function() {
        $(".wheelImage").popImg();
    });
// $(".form-control-file").click(function(){
//     // $new = $(this).clone().removeClass('dropify');
//     // $(this).after($new);

//   $(this).parent().closest('.dropify-wrapper').find('.hidden-file-input').click();
// });

    
</script>
@endsection