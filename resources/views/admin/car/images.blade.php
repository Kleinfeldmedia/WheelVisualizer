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
</style>
<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap drp-lst">
                    <h4>Cars List</h4>
                    <div class="add-product">
                        <a data-toggle="modal" data-target="#myModal">Add Car</a>
                    </div>
                    <div class="asset-inner">
                        <table>
                            <thead>
                                <tr>
                                    <th> S.No</th>
                                    <th>Car ID </th>
                                    <th>Name </th>
                                    <th>CC </th>
                                    <th>Color</th>
                                    <th>Image </th>
                                    <th> Actions</th>
                                </tr>
                            </thead>
                            @forelse(@$cars as $key => $car)

                            <tr>
                                <td>{{@$key+1}}</td>
                                <td>{{@$car->car_id}} </td>
                                <td>{{@$car->CarColor->where('code',@$car->color_code)->first()->name}}</td>
                                <td>{{@$car->cc}} </td>
                                <td>{{@$car->CarColor->where('code',@$car->color_code)->first()->simple}}</td>
                                <td><img class="wheelImage" src="{{asset(@$car->image)}}"></td>
                                <!-- <td><a class="btn btn-default look-a-like" href="{{url('admin/car/images')}}/{{@$car->id}}" >View</a></td> -->
                                <td>
                                    <form action="{{ route('admin.car.images.destroy', $car->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">

                                    <a class="btn btn-default look-a-like" data-toggle="modal" data-target="#myModal{{@$key}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <button class="btn btn-default look-a-like" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <!--  Edit Model Start-->
                            <div class="modal fade" id="myModal{{@$key}}" role="dialog">

                                <div class="modal-body admin-form">
                                    <!-- New Model Content Start -->
                                    <div class="product-payment-inner-st edit_modal">
                                        <form action="{{route('admin.car.images.update',@$car->id)}}" class="dropzone dropzone-custom needsclick add-professors dz-clickable" id="demo1-upload" method="POST" enctype="multipart/form-data">
                                            {{@csrf_field()}}
                                            {{@method_field('PATCH')}}
                                            <ul id="myTabedu1" class="tab-review-design">
                                                <li class="active"><a href="#description2">Update Car Image Details</a></li>
                                            </ul>
                                            <div id="myTabContent" class="tab-content custom-product-edit">
                                                <div class="product-tab-list tab-pane fade active in" id="description2">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="review-content-section">
                                                                <div id="dropzone1" class="pro-ad upload-section">
                                                                    <div class="row fixed-upload-file">
                                                                        <?php $car_color = @$car->CarColor->where('code',@$car->color_code)->first(); ?>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="cc">CC <span class="req">*</span></label>
                                                                                <input type="text" name="cc" class="form-control" placeholder="Enter CC" value="{{$car->cc}}" required="">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="color_code">Color Code <span class="req">*</span></label>
                                                                                <input type="text" name="color_code" class="form-control" placeholder="Color Code " value="{{$car->color_code}}" required="">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="evoxcode">Evox Code <span class="req">*</span></label>
                                                                                <input type="text" name="evoxcode" class="form-control" placeholder="Color Code " value="{{@$car_color->evoxcode}}" required="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="name">Full Name <span class="req">*</span></label>
                                                                                <input type="text" name="name" class="form-control" placeholder="Full name" value="{{@$car_color->name}}" required="">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="simple">Simple Name <span class="req">*</span></label>
                                                                                <input type="text" name="simple" class="form-control" placeholder="Simple Name " value="{{@$car_color->simple}}" required="">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="rgb1">RGB Color <span class="req">*</span></label>
                                                                                <input type="text" name="rgb1" class="form-control" placeholder="RGB Color Code" value="{{@$car_color->rgb1}}" required="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                             <div class="row">Uploaded  Image</div>

                                                        <div class="row"> 
                                                            <div class="col-md-6 show-image">
                                                                    <div class="col-md-6">
                                                                        <img id="profile-img-{{$key}}" src="{{asset($car->image)}}" style="width:100px !important;height:auto !important">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <input class="delete profile-img-delete   btn btn-danger" type="button"  data-key="{{$key}}" value="Remove Image"  style="display: {{(@$user->profileimage)?'block':'none'}};" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="file" class="form-control profile-img"  id="profile-img-input-{{$key}}" data-key="{{$key}}"  name="car_image" style="display: {{(@$user->profileimage)?'none':'block'}};" >
                                                                </div>
                                                        </div> 

                                                                           <!--  <label for="fname">Upload Image <span class="req">*</span></label>
                                                                            <br>
                                                                            <input type="file" accept="image/*" name="car_image" class="car_image dropify form-control-file" aria-describedby="fileHelp" required="" data-default-file="{{asset($car->image)}}">
                                                                            <br> -->
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="payment-adress">
                                                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Update">

                                                        <input type="reset" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" value="Cancel">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- New Model Content End -->
                            @empty
                            <tr>
                                <td colspan="6">No Car Images found</td>
                            </tr>
                            @endforelse
                        </table>

                        {{$cars->appends(['diameter' => @Request::get('diameter'),'width' => @Request::get('width'),'brand' => @Request::get('brand'),'car_id' => @Request::get('car_id'),'page' => @Request::get('page')])->links()}}
                    </div>

                    <!--  New Model Start-->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog admin-form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Car Information</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- New Model Content Start -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="product-payment-inner-st">
                                            <form action="{{ route('admin.car.images.store', $vif->id) }}" class="dropzone dropzone-custom needsclick add-professors dz-clickable" id="demo1-upload" method="POST"  enctype="multipart/form-data">
                                                {{@csrf_field()}}
                                                <input type="hidden" name="vif" value="{{$vif->vif}}">
                                                <ul id="myTabedu1" class="tab-review-design">
                                                    <li class="active"><a href="#description2">Car Images</a></li>
                                                </ul>
                                                <div id="myTabContent" class="tab-content custom-product-edit">
                                                    <div class="product-tab-list tab-pane fade active in" id="description2">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="review-content-section">
                                                                    <div id="dropzone1" class="pro-ad upload-section">

                                                                       <!--  <div class="row">
                                                                            <a class="btn btn-success add-upload">Add New</a>
                                                                            <a class="btn btn-danger remove-upload">Remove One</a>
                                                                        </div> -->
                                                                        <div class="row fixed-upload-file">

                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="cc">CC <span class="req">*</span></label>
                                                                                    <input type="text" name="cc[]" class="form-control" placeholder="Enter CC" value="{{old('cc')}}" required="">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="color_code">Color Code <span class="req">*</span></label>
                                                                                    <input type="text" name="color_code[]" class="form-control" placeholder="Color Code " value="{{old('color_code')}}" required="">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="evoxcode">Evox Code <span class="req">*</span></label>
                                                                                    <input type="text" name="evoxcode[]" class="form-control" placeholder="Color Code " value="{{old('evoxcode')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label for="name">Full Name <span class="req">*</span></label>
                                                                                    <input type="text" name="name[]" class="form-control" placeholder="Full name" value="{{old('name')}}" required="">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="simple">Simple Name <span class="req">*</span></label>
                                                                                    <input type="text" name="simple[]" class="form-control" placeholder="Simple Name " value="{{old('simple')}}" required="">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="rgb1">RGB Color <span class="req">*</span></label>
                                                                                    <input type="text" name="rgb1[]" class="form-control" placeholder="RGB Color Code" value="{{old('rgb1')}}" required="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                                <label for="fname">Upload Image <span class="req">*</span></label>
                                                                                <br>
                                                                                <input type="file" accept="image/*" name="car_image" class="car_image dropify form-control-file" aria-describedby="fileHelp" required="" data-default-file="{{old('car_image')}}">
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="payment-adress">
                                                                                <input type="submit" class="btn btn-primary waves-effect waves-light" value="Submit">

                                                                                <input type="reset" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" value="Cancel">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
    })


 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (function (input) {   
                
                var key = $(input).data('key');
                return function(e){
                    $('#profile-img-'+key).attr('src', e.target.result);
                };

            })(input); 
            reader.readAsDataURL(input.files[0]);
        }
    } 

    $('.profile-img').change(function(){ 
        readURL(this); 
        var key = $(this).data('key');
        $('#profile-img-input-'+key).hide();
        $('.profile-img-delete').show();
    });

    $('.profile-img-delete').click(function(){
        var key = $(this).data('key');
        $('#profile-img-input-'+key).show();
        $('.profile-img-delete').hide();
        $('#profile-img-input-'+key).val('');
        $('#profile-img-'+key).attr('src',$('#profile-img-list-'+key).attr('src'));
    })


</script>
@endsection