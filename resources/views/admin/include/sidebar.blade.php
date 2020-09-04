    <!-- Start Left menu area -->
    
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="{{url('/admin/home')}}"><img class="main-logo" src="{{url(Setting::get('site_logo','/admin/img/logo/logo.png'))}}" alt="" /></a>
               </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
 
                        <li>
                            <a  href="{{url('admin/home')}}" aria-expanded="false"><i class="fa fa-home "></i> Home   </a>
                        </li>
                        @if(@Auth::guard('admin')->user()->is_super == '1')
                        <li>
                            <a  href="{{url('admin/subadmin')}}" aria-expanded="false"><i class="fa fa-user "></i> Sub Admins  </a>
                        </li>
                        @else
                        <li>
                            <a  href="{{url('admin/subadmin')}}/{{@Auth::guard('admin')->user()->id}}" aria-expanded="false"><i class="fa fa-user "></i> My Profile  </a>
                        </li>
                        @endif

                        @if(VerifyAccess('user'))
                        <li>
                            <a  href="{{url('admin/user')}}" aria-expanded="false"><i class="fa fa-user "></i> Users  </a>
                        </li>
                        @endif

                        @if(VerifyAccess('orders'))
                        <li>
                            <a  href="{{url('admin/orders')}}" aria-expanded="false"><i class="fa fa-shopping-cart "></i> Orders  </a>
                        </li>
                        @endif

                        @if(VerifyAccess('enquiry'))
                        <li>
                            <a  href="{{url('admin/enquiry')}}" aria-expanded="false"><i class="fa fa-envelope "></i> Enquiries  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('feedback'))
                        <li>
                            <a  href="{{url('admin/feedback')}}" aria-expanded="false"><i class="fa fa-comments-o "></i> Feedbacks  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('post'))
                        <li>
                            <a  href="{{url('admin/post')}}" aria-expanded="false"><i class="fa fa-sticky-note-o"></i> Posts  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('car'))
                        <li>
                            <a  href="{{url('admin/car')}}" aria-expanded="false"><i class="fa fa-car "></i> Cars   </a>
                        </li>
                        @endif

                        @if(VerifyAccess('wheel'))
                        <li>
                            <a  href="{{url('admin/wheel')}}" aria-expanded="false"><i class="fa fa-cogs "></i> Wheels  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('wheelproduct'))
                        <li>
                            <a  href="{{url('admin/wheelproduct')}}" aria-expanded="false"><i class="fa fa-list "></i> Wheel Products  </a>
                        </li>
                        @endif


                        @if(VerifyAccess('tire'))
                        <li>
                            <a  href="{{url('admin/tire')}}" aria-expanded="false"><i class="fa fa-list "></i> Tires  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('brands'))
                        <li>
                            <a  href="{{url('admin/brands')}}" aria-expanded="false"><i class="fa fa-list "></i> Tire Brands  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('vehicle'))
                        <li>
                            <a  href="{{url('admin/vehicle')}}" aria-expanded="false"><i class="fa fa-list "></i> Vehicles  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('chassis'))
                        <li>
                            <a  href="{{url('admin/chassis')}}" aria-expanded="false"><i class="fa fa-list "></i> Chassis List  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('ticket'))
                        <li>
                            <a  href="{{url('admin/ticket')}}" aria-expanded="false"><i class="fa fa-list "></i> Tickets  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('review'))
                        <li>
                            <a  href="{{url('admin/review')}}" aria-expanded="false"><i class="fa fa-list "></i> Reviews / Ratings  </a>
                        </li>
                        @endif

                        @if(VerifyAccess('metakeywords'))
                        <li>
                            <a  href="{{url('admin/metakeywords')}}" aria-expanded="false"><i class="fa fa-tag "></i>  Meta Keywords   </a>
                        </li> 
                        @endif
                        @if(VerifyAccess('slider'))
                        <li>
                            <a  href="{{url('admin/slider')}}" aria-expanded="false"><i class="fa fa-list "></i> Sliders  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('dropshipper'))
                        <li>
                            <a  href="{{url('admin/dropshipper')}}" aria-expanded="false"><i class="fa fa-list "></i> Dropshippers  </a>
                        </li>
                        @endif
 

                        @if(VerifyAccess('logs'))
                        <li>
                            <a  href="{{url('admin/logs/vftp')}}" aria-expanded="false"><i class="fa fa-list "></i> FTP Live Details  </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/logs/process')}}" aria-expanded="false"><i class="fa fa-list "></i> FTP Current Process  </a>
                        </li>
                        @endif
                        @if(VerifyAccess('cmspage'))
                        <li>
                            <a  href="{{url('admin/cmspage')}}" aria-expanded="false"><i class="fa fa-list "></i> CMS Pages  </a>
                        </li>
                        @endif
 
<!--                         <li>
                            <a  href="{{url('admin/setting')}}" aria-expanded="false"><i class="fa fa-cog "></i> Settings  </a>
                        </li> -->
                        @if(VerifyAccess('cms'))
                        <li>
                            <a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-file "></i> Settings</a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a title="Header Page" href="{{url('admin/cms/setting')}}"> <i class="fa fa-cog"></i>  Application Setting </a></li> 
                                <li><a title="Home Page" href="{{url('admin/cms/home')}}"> <i class="fa fa-home"></i>  Home Page Setting</a></li> 
                                <!-- <li><a title="Information Page" href="{{url('admin/cms/information')}}"> <i class="fa fa-info-circle" aria-hidden="true"></i>  Information Tab Setting</a></li>  -->
                                <!-- <li><a title="All Pages" href="{{url('admin/cmspage')}}"> <i class="fa fa-info-circle" aria-hidden="true"></i>  All Pages</a></li>  -->
                            </ul>
                        </li>
                        @endif




                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->