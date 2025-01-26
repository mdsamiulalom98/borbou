<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />

        <title>@yield('title') - {{$generalsetting->name}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset($generalsetting->favicon)}}">

		<!-- Bootstrap css -->
		<link href="{{asset('public/backEnd/') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- App css -->
		<link href="{{asset('public/backEnd/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css"/>
		<!-- icons -->
		<link href="{{asset('public/backEnd/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- toastr css -->
        <link rel="stylesheet" href="{{asset('public/backEnd/') }}/assets/css/toastr.min.css">
        <!-- custom css -->
        <link href="{{asset('public/backEnd/') }}/assets/css/custom.css" rel="stylesheet" type="text/css" />
		<!-- Head js -->
        @yield('css')
		<script src="{{asset('public/backEnd/') }}/assets/js/head.js"></script>

    </head>

    <!-- body start -->
    <body data-layout-mode="default" data-theme="light" data-layout-width="fluid" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-end mb-0">

                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{asset(Auth::user()->image)}}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="{{ route('dashboard') }}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>Dashboard</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('change_password') }}" class="dropdown-item notify-item">
                                    <i class="fe-settings"></i>
                                    <span>Change Password</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('locked') }}" class="dropdown-item notify-item">
                                    <i class="fe-lock"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>

                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ url('admin/dashboard') }}" class="logo logo-dark text-center">
                            <span class="logo-sm">
                               <img src="{{asset($generalsetting->white_logo)}}" alt="" height="40">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset($generalsetting->white_logo)}}" alt="" height="40">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>

                        <a href="{{ url('admin/dashboard') }}" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{asset($generalsetting->white_logo)}}" alt="" height="40">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset($generalsetting->white_logo)}}" alt="" height="40">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="dropdown d-none d-xl-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light"  href="{{route('home')}}" target="_blank" >
                               Visit Site
                                <i class="mdi mdi-world"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="{{asset('public/backEnd/') }}/assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-bs-toggle="dropdown">{{Auth::user()->name}}</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock me-1"></i>
                                    <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">


                            <li>
                                <a href="{{ url('admin/dashboard') }}" data-bs-toggle="collapse">
                                    <i data-feather="airplay"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Apps</li>
                            <!-- nav items -->
                            <li>
                                <a href="#sidebar-download" data-bs-toggle="collapse">
                                    <i data-feather="download"></i>
                                    <span> Download </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebar-download">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('downloads.index') }}">Download</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items -->
                            <li>
                                <a href="#sidebar-members" data-bs-toggle="collapse">
                                    <i data-feather="user"></i>
                                    <span> Member </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebar-members">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('members.new') }}">New Members</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('members.index') }}">Members</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('members.old') }}">Old Members</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('members.birthday') }}">Member's Birthday</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items -->
                            <li>
                                <a href="#sidebar-users" data-bs-toggle="collapse">
                                    <i data-feather="user"></i>
                                    <span> Users </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebar-users">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('users.index') }}">Admin</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items -->
                            <li>
                                <a href="#siebar-roles" data-bs-toggle="collapse">
                                    <i data-feather="power"></i>
                                    <span> Roles </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="siebar-roles">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('roles.create') }}">New</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('roles.index') }}">Manage</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items end -->
                            <li>
                                <a href="#siebar-permissions" data-bs-toggle="collapse">
                                    <i data-feather="lock"></i>
                                    <span> Permissions </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="siebar-permissions">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('permissions.create') }}">New</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('permissions.index') }}">Manage</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items end -->
                            <li>
                                <a href="#siebar-attributes" data-bs-toggle="collapse">
                                    <i data-feather="grid"></i>
                                    <span> Attributes </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="siebar-attributes">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('maritalstatus.index') }}">Marital Status Manage</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('religion.index') }}">Religion Manage</a>
                                        </li>
                                        
                                        
                                        <li>
                                            <a href="{{ route('profession.index') }}">Profession Manage</a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{ route('complexion.index') }}">Complexion Manage</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('bloodgroup.index') }}">Blood Group Manage</a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{ route('country.index') }}">Country Manage</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('degree.index') }}">Degree Manage</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('working.index') }}">Working Manage</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('location.index') }}">Location Manage</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items end -->

                            <li>
                                <a href="#siebar-success" data-bs-toggle="collapse">
                                    <i data-feather="smile"></i>
                                    <span> Success </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="siebar-success">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('success.create') }}">Create</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('success.index') }}">Manage</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <!-- nav items end -->

                            <li class="menu-title mt-2">Website Setting</li>
                            <li>
                                <a href="#siebar-sitesetting" data-bs-toggle="collapse">
                                    <i data-feather="settings"></i>
                                    <span> Site Setting </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="siebar-sitesetting">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('settings.index') }}">General Setting</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('socialmedias.index') }}">Social Media</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact.index') }}">Contact</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pages.index') }}">Create Page</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- nav items end -->
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <div class="content">

                    @yield('content')

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                 &copy; Copyright by <a href="#">{{$generalsetting->name }}</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>



        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    <div class="tab-pane" id="chat-tab" role="tabpanel">

                        <form class="search-bar p-3">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="fw-medium p-3 m-0 text-uppercase">Working Tasks</h6>

                    </div>
                    <div class="tab-pane active" id="settings-tab" role="tabpanel">
                        <h6 class="fw-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">Theme Settings</span>
                        </h6>

                        <div class="p-3">
                            <div class="alert alert-warning" role="alert">
                                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                            </div>

                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                                    id="light-mode-check" checked />
                                <label class="form-check-label" for="light-mode-check">Light Mode</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                                    id="dark-mode-check" />
                                <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                            </div>

                            <!-- Width -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-width" value="fluid" id="fluid-check" checked />
                                <label class="form-check-label" for="fluid-check">Fluid</label>
                            </div>
                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="layout-width" value="boxed" id="boxed-check" />
                                <label class="form-check-label" for="boxed-check">Boxed</label>
                            </div>

                            <!-- Menu positions -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="menu-position" value="fixed" id="fixed-check"
                                    checked />
                                <label class="form-check-label" for="fixed-check">Fixed</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="menu-position" value="scrollable"
                                    id="scrollable-check" />
                                <label class="form-check-label" for="scrollable-check">Scrollable</label>
                            </div>

                            <!-- Left Sidebar-->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="light" id="light-check" />
                                <label class="form-check-label" for="light-check">Light</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark" id="dark-check" checked/>
                                <label class="form-check-label" for="dark-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand" id="brand-check" />
                                <label class="form-check-label" for="brand-check">Brand</label>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient" id="gradient-check" />
                                <label class="form-check-label" for="gradient-check">Gradient</label>
                            </div>

                            <!-- size -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                                    id="default-size-check" checked />
                                <label class="form-check-label" for="default-size-check">Default</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                                    id="condensed-check" />
                                <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                                    id="compact-check" />
                                <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                            </div>

                            <!-- User info -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="sidebar-user" value="fixed" id="sidebaruser-check" />
                                <label class="form-check-label" for="sidebaruser-check">Enable</label>
                            </div>


                            <!-- Topbar -->
                            <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check"
                                    checked />
                                <label class="form-check-label" for="darktopbar-check">Dark</label>
                            </div>

                            <div class="form-check form-switch mb-1">
                                <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                <label class="form-check-label" for="lighttopbar-check">Light</label>
                            </div>


                            <div class="d-grid mt-4">
                                <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                               </div>

                        </div>

                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{asset('public/backEnd/') }}/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="{{asset('public/backEnd/') }}/assets/js/app.min.js"></script>
        <script src="{{asset('public/backEnd/') }}/assets/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        <script src="{{asset('public/backEnd/') }}/assets/js/sweetalert.min.js"></script>
        <script type="text/javascript">
             $('.delete-confirm').click(function(event) {
                  var form =  $(this).closest("form");
                  event.preventDefault();
                  swal({
                      title: `Are you sure you want to delete this record?`,
                      text: "If you delete this, it will be gone forever.",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      form.submit();
                    }
                  });
              });
             $('.change-confirm').click(function(event) {
                  var form =  $(this).closest("form");
                  event.preventDefault();
                  swal({
                      title: `Are you sure you want to change this record?`,
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      form.submit();
                    }
                  });
              });
        </script>

        @yield('script')
        <script>
        // district selection
        $("#division_id").change(function () {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{url('ajax-location-district')}}?division_id=" + ajaxId,
                    success: function (res) {
                        if (res) {
                            $("#district_id").empty();
                            $("#district_id").append('<option value="0">Select..</option>');
                            $.each(res, function (key, value) {
                                $("#district_id").append('<option value="' + key + '">' + value + "</option>");
                            });
                        } else {
                            $("#district_id").empty();
                        }
                    },
                });
            } else {
                $("#district_id").empty();
                $("#district_id").empty();
            }
        });

        // upazila selection
        $("#district_id").change(function () {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{url('ajax-location-upazila')}}?district_id=" + ajaxId,
                    success: function (res) {
                        if (res) {
                            $("#upazila_id").empty();
                            $("#upazila_id").append('<option value="0">Select..</option>');
                            $.each(res, function (key, value) {
                                $("#upazila_id").append('<option value="' + key + '">' + value + "</option>");
                            });
                        } else {
                            $("#upazila_id").empty();
                        }
                    },
                });
            } else {
                $("#upazila_id").empty();
                $("#upazila_id").empty();
            }
        });

                // educational level
        $("#education").change(function () {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{url('ajax-education-degree')}}?level_id=" + ajaxId,
                    success: function (res) {
                        if (res) {
                            $("#degree").empty();
                            $("#degree").append('<option value="0">নির্বাচন করুন..</option>');
                            $.each(res, function (key, value) {
                                $("#degree").append('<option value="' + key + '">' + value + "</option>");
                            });
                        } else {
                            $("#degree").empty();
                        }
                    },
                });
            } else {
                $("#degree").empty();
                $("#degree").empty();
            }
        });

        </script>
    </body>
</html>
