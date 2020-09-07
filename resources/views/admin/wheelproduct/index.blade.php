@extends('admin.layouts.app')

@section('content')



<?php
$is_read_access = VerifyAccess('wheelproduct','read');
$is_write_access = VerifyAccess('wheelproduct','write');
?>




<style type="text/css">
    .req {
        color: red;
    }

    .edit_modal {
        margin: 6%;
        padding: 20px;
    }
    td.desc{ overflow-y:scroll;overflow-x:scroll;width: 10% !important;} 


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
                    <h4>List of Wheel Products</h4> 
                    <div style="text-align:right;padding-bottom: 20px">
                    @if($is_write_access)
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Product</button>
                    @endif
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#csvModal">Upload CSV </button>
                    
                    <a  class="btn btn-info"  href="{{url('admin/exportTable')}}?module=WheelProduct">Export CSV </a>
                    
                    </div>
                    <div class="asset-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Brand</th>
                                    <th>Model</th> 
                                    <th>Image</th> 
                                    <th> Actions</th>
                                </tr>
                            </thead>
                            <?php $i=1; ?>
                            @forelse(@$wheelproducts as $key => $wheel)
                            <?php $wheel = (object)$wheel; ?>
                            <tr>
                                <td>{{@$i++}}</td>
                                <td>{{@$wheel->prodbrand}}</td>
                                <td>{{@$wheel->prodmodel}}</td> 
                                <td><img class="wheelImage" src="{{ViewImage(@$wheel->prodimage)}}" width="100px" height="100px"></td> 
                                <td>
                                    <a class="btn btn-default" href="{{url('/admin/wheelproduct')}}/{{base64_encode(@$wheel->id)}}/model"><i class="fa fa-eye" aria-hidden="true"></i> View Models</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Users found</td>
                            </tr>
                            @endforelse
                        </table>

                        {{$wheelproducts->appends(['diameter' => @Request::get('diameter'),'width' => @Request::get('width'),'brand' => @Request::get('brand'),'car_id' => @Request::get('car_id'),'page' => @Request::get('page')])->links()}}
                    </div>

                    <!--  New Model Start-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog admin-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Wheel Information</h4>
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
                                                                    <form action="{{url('/admin/wheelproduct/')}}" class="dropzone dropzone-custom needsclick add-professors dz-clickable" id="demo1-upload" method="POST" enctype="multipart/form-data">
                                                                        {{@csrf_field()}}
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="brand">Brand <span class="req">*</span></label>
                                                                                    <select class="form-control select2 Brand" name="prodbrand" required="">
                                                                                        <option value="">Select Brand</option>
                                                                                     @foreach(getWheelBrandList() as $brand)
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
                                                                                    <label for="prodfinish">Product Finish <span class="req">*</span></label>
                                                                                    <input type="text" name="prodfinish" class="form-control" placeholder="Product Finish" required="" value="{{old('prodfinish')}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="partno">Part Number <span class="req">*</span></label>
                                                                                    <input type="text" name="partno" class="form-control" placeholder="Part Number" value="{{old('partno')}}" required="">
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
                                                                                <label for="prodimagedually">Product Image Dually </label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="prodimagedually" class="dropify form-control-file" aria-describedby="fileHelp" data-default-file="{{old('prodimagedually')}}">
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
                                                                            
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="partno_old">Visualiser / Old Partnumber  </label>
                                                                                    <input type="text" name="partno_old" class="form-control" placeholder="Old Partnumber" value="{{old('partno_old')}}"  >
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="qtyavail">Quantity Available  <span class="req">*</span></label>
                                                                                    <input type="text" name="qtyavail" class="form-control" placeholder="Quantity Available" value="{{old('qtyavail')}}"  required="">
                                                                                </div>
                                                                            </div>  
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="duallyrear">Dually Rear?</label>
                                                                                    <select class="form-control select2" name="duallyrear">
                                                                                        <option value="">Select One</option>
                                                                                        <option value="1">Yes</option>
                                                                                        <option value="0">No</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>                 
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="wheeltype">Wheel Type  </label>
                                                                                    <input type="text" name="wheeltype" class="form-control" placeholder="Wheel Type" value="{{old('wheeltype')}}"  >
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="wheeldiameter">Wheel Diameter <span class="req">*</span></label>
                                                                                    <input type="number" name="wheeldiameter" class="form-control" placeholder="Diameter" value="{{old('wheeldiameter')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="wheelwidth">Wheel Width <span class="req">*</span></label>
                                                                                    <input type="number" name="wheelwidth" class="form-control" placeholder="Width " value="{{old('wheelwidth')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row"> 
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="offset1">Offset 1</label>
                                                                                    <input type="number" name="offset1" class="form-control" placeholder="Offset 1" value="{{old('offset1')}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="offset2">Offset 2</label>
                                                                                    <input type="number" name="offset2" class="form-control" placeholder="Offset 2" value="{{old('offset2')}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="boltpattern1">Bolt Pattern1</label>
                                                                                    <input type="text" name="boltpattern1" class="form-control" placeholder="Pattern 1" value="{{old('boltpattern1')}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="boltpattern2">Bolt Pattern2</label>
                                                                                    <input type="text" name="boltpattern2" class="form-control" placeholder="Pattern 2" value="{{old('boltpattern2')}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="boltpattern3">Bolt Pattern3</label>
                                                                                    <input type="text" name="boltpattern3" class="form-control" placeholder="Pattern 3" value="{{old('boltpattern3')}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                                                                                    <label for="rf_lc">RF / LC ?</label>
                                                                                    <select class="form-control select2" name="rf_lc">
                                                                                        <option value="">Select One</option>
                                                                                        <option value="RF">RF</option>
                                                                                        <option value="LC">LC</option>
                                                                                    </select>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                <label for="hubbore"> Hubbore</label> 
                                                                                    <input type="number" step="any" name="hubbore" class="form-control" placeholder="Hubbor" value="{{old('hubbore')}}" >
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
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="salestart">Sale StartAt</label>
                                                                                    <input class="form-control" type="datetime-local"  name="salestart" value="{{old('salestart')}}"  >
                                                                                </div>
                                                                            </div>   
                                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="saleexp">Sale ExpireAt</label>
                                                                                    <input class="form-control" type="datetime-local"  name="saleexp" value="{{old('saleexp')}}"  >
                                                                                </div>
                                                                            </div>  
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
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

                                                                    <form action="{{url('/admin/wheelproduct/uploadcsv')}}" class="dropzone dropzone-custom needsclick add-professors dz-clickable" id="demo1-upload" method="POST" enctype="multipart/form-data">
                                                                        {{@csrf_field()}} 
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                <label for="prodimage">CSV Formated File <span class="req">*</span></label>
                                                                                <br>
                                                                                <input type="file"  name="wheelproductsfile"  class="dropify form-control-file" aria-describedby="fileHelp" required="">
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
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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