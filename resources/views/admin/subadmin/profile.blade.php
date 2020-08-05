@extends('admin.layouts.app') @section('content')
<style type="text/css">
    .profile-img-section {
        text-align: center;
    }
</style>

<!-- Start -->
<div class="product-status mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="single-pro-review-area mt-t-30 mg-b-15">
                <div class="container-fluid">

                    <div class="row" style="min-height: 680px;">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                            <div class="product-status-wrap drp-lst">
                                <h3>My Profile</h3>
                                <p style="float: right;">
                                    <a type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit" style="float: right !important;"></i></a>
                                </p>
                            </div>
                            <div class="profile-info-inner">
                                <div class="profile-img-section">
                                    <img class="static-profile-img" src="{{ViewUserProfileImage($admin->profileimage)}}" alt="" />
                                </div>
                                <div class="profile-details-hr">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="address-hr">
                                                <p><b>Name</b><br /> {{@$admin->name}} </p>
                                            </div>
                                        </div> 
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                            <div class="address-hr">
                                                <p><b>Email ID</b><br /> {{@$admin->email?:'-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                            <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                                <p><b>Mobile</b><br /> {{@$admin->mobile?:'-'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                            <div class="address-hr">
                                                <p><b>Address</b><br /> {{@$admin->address?:'-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                            <div class="address-hr">
                                                <p><b>Zipcode</b><br /> {{@$admin->zipcode?:'-'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <!-- <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <h3>500</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <h3>900</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <h3>600</h3>
                                        </div>
                                    </div>
                                </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        </div>
                        <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                        <div class="profile-info-inner">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Name</b><br /> Fly Zend</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>Designation</b><br /> Head of Dept.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr">
                                            <p><b>Email ID</b><br /> fly@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                        <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                            <p><b>Mobile</b><br /> +01962067309</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="address-hr">
                                            <p><b>Address</b><br /> E104, catn-2, Chandlodia Ahmedabad Gujarat, UK.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <h3>500</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <h3>900</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="address-hr">
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <h3>600</h3>
                                        </div>
                                    </div>
                                </div>
                        </div>



                    </div> -->
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal" role="dialog">
                <div class="modal-dialog admin-form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Your Profile</h4>
                        </div>
                        <div class="modal-body">
                            <div id="dropzone1" class="pro-ad addcoursepro">
                                <form action="{{ route('admin.subadmin.update', $admin->id)}}" class=" needsclick addcourse" method="POST" id="update-post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('PATCH')}}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-1">
                                                <label>Full Name</label>
                                            </div>
                                            <div class="col-md-11">
                                                <input type="text" name="name" class="form-control" placeholder="Give the Full Name" required="" value="{{$admin->name}}">
                                            </div>
                                        </div> 
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-2">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="email" name="email" class="form-control" placeholder="Give the email id" required="" value="{{$admin->email}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-2">
                                                <label>Mobile</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="mobile" class="form-control" placeholder="Give the mobile number" value="{{$admin->mobile}}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-2">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea name="address" class="form-control" placeholder="Give your address">{{$admin->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-2">
                                                <label>Zipcode</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="zipcode" class="form-control" placeholder="Give the zipcode" value="{{$admin->zipcode}}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-2">
                                                <label>Profile Image</label>
                                            </div>

                                            <div class="col-md-10">
                                                <div class="col-md-6 show-image">
                                                    <div class="col-md-6">
                                                        <img id="profile-img" src="{{ViewUserProfileImage($admin->profileimage)}}" style="width:100px !important;height:auto !important">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input class="delete profile-img-delete btn btn-danger" type="button" value="Remove Image" style="display: {{(@$admin->profileimage)?'block':'none'}};" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control profile-img" id="profile-img-input" name="profileimage" style="display: {{(@$admin->profileimage)?'none':'block'}};">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="payment-adress">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="payment-adress">
                                                <a class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

@endsection

@section('custom_scripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (function(input) {

                // var key = $(input).data('key');
                return function(e) {
                    $('#profile-img').attr('src', e.target.result);
                };

            })(input);
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.profile-img').change(function() {
        readURL(this);
        $('#profile-img-input').hide();
        $('.profile-img-delete').show();
    });

    $('.profile-img-delete').click(function() {
        $('#profile-img-input').show();
        $('.profile-img-delete').hide();
        $('#profile-img-input').val('');
        console.log($('.static-profile-img').attr('src'))
        $('#profile-img').attr('src', $('.static-profile-img').attr('src'));
    })
</script>
@endsection