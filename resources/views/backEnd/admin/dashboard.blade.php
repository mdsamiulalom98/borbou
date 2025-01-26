@extends('backEnd.layouts.master')
@section('title','Dashboard')
@section('css')
<!-- Plugins css -->
<link href="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backEnd/')}}/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex align-items-center mb-3">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control border" id="dash-daterange">
                            <span class="input-group-text bg-blue border-blue text-white">
                                <i class="mdi mdi-calendar-range"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
       
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <i class="fe-shopping-bag font-22 avatar-title text-success"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$today_order}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Today's Download</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <i class="fe-database font-22 avatar-title text-info"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$last_month_download}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Last Month</p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div> <!-- end widget-rounded-circle -->
        </div> <!-- end col -->
        
         <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <i class="fe-shopping-cart font-22 avatar-title text-primary"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$total_order}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Total Download</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->



        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <i class="fe-user font-22 avatar-title text-warning"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$total_member}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Members</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        <!--<div class="col-lg-4">-->
        <!--    <div class="card">-->
        <!--        <div class="card-body">-->
        <!--            <div class="dropdown float-end">-->
        <!--                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--                    <i class="mdi mdi-dots-vertical"></i>-->
        <!--                </a>-->
        <!--                <div class="dropdown-menu dropdown-menu-end">-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Action</a>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <h4 class="header-title mb-0">Total Revenue</h4>-->

        <!--            <div class="widget-chart text-center" dir="ltr">-->
                        
        <!--                <div id="total-revenue" class="mt-0"  data-colors="#f1556c"></div>-->

        <!--                <h5 class="text-muted mt-0">Total download  ratio</h5>-->
        <!--                <h2>{{$total_delivery}}</h2>-->

        <!--                <p class="text-muted w-75 mx-auto sp-line-2">Total order to paid payment check and get download ratio</p>-->

        <!--                <div class="row mt-3">-->
        <!--                    <div class="col-4">-->
        <!--                        <p class="text-muted font-15 mb-1 text-truncate">Today</p>-->
        <!--                        <h4><i class="fas fa-calendar-day text-danger me-1"></i>{{$today_order}}</h4>-->
        <!--                    </div>-->
        <!--                    <div class="col-4">-->
        <!--                        <p class="text-muted font-15 mb-1 text-truncate">Last week</p>-->
        <!--                        <h4><i class="fas fa-calendar-alt text-success me-1"></i>{{$last_week_download}}</h4>-->
        <!--                    </div>-->
        <!--                    <div class="col-4">-->
        <!--                        <p class="text-muted font-15 mb-1 text-truncate">Last Month</p>-->
        <!--                        <h4><i class="fas fa-database text-danger me-1"></i>{{$last_month_download}}</h4>-->
        <!--                    </div>-->
        <!--                </div>-->
                        
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div> <!-- end card -->
        <!--</div> <!-- end col-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Today's Downloads</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Downloader</th>
                                    <th>Member ID</th>
                                    <th>Downloaded</th>
                                    <th>Member ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($today_download as $today)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$today->visitor?$today->visitor->fullName:''}}
                                    </td>
                                    <td>
                                        {{$today->visitor?$today->visitor->id:''}}
                                    </td>
                                    <td>
                                        {{$today->name}}
                                    </td>
                                    <td>{{$today->member_id}}</td>
                                    
                                    <td>{{date('d-m-Y', strtotime($today->created_at))}}</td>
                                    <td>{{date('h:i a', strtotime($today->created_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <!--<div class="col-xl-6">-->
        <!--    <div class="card">-->
        <!--        <div class="card-body">-->
        <!--            <div class="dropdown float-end">-->
        <!--                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">-->
        <!--                    <i class="mdi mdi-dots-vertical"></i>-->
        <!--                </a>-->
        <!--                <div class="dropdown-menu dropdown-menu-end">-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>-->
                            <!-- item-->
        <!--                    <a href="javascript:void(0);" class="dropdown-item">Action</a>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <h4 class="header-title mb-3">Latest Customers</h4>-->

        <!--            <div class="table-responsive">-->
        <!--                <table class="table table-borderless table-nowrap table-hover table-centered m-0">-->

        <!--                    <thead class="table-light">-->
        <!--                        <tr>-->
        <!--                            <th>Id</th>-->
        <!--                            <th>Name</th>-->
        <!--                            <th>Phone</th>-->
        <!--                            <th>Date</th>-->
        <!--                            <th>Status</th>-->
        <!--                        </tr>-->
        <!--                    </thead>-->
        <!--                    <tbody>-->
        <!--                        @foreach($latest_member as $member)-->
        <!--                        <tr>-->
        <!--                            <td>-->
        <!--                                <h5 class="m-0 fw-normal">{{$loop->iteration}}</h5>-->
        <!--                            </td>-->

        <!--                            <td>-->
        <!--                                {{$member->fullName}}-->
        <!--                            </td>-->

        <!--                            <td>-->
        <!--                                {{$member->phoneNumber}}-->
        <!--                            </td>-->

        <!--                            <td>-->
        <!--                                {{$member->created_at->format('d-m-Y')}}-->
        <!--                            </td>-->

        <!--                            <td>-->
        <!--                                {{$member->status==1?'Active':'Inactive'}}-->
        <!--                            </td>-->
        <!--                        </tr>-->
        <!--                        @endforeach-->
        <!--                    </tbody>-->
        <!--                </table>-->
        <!--            </div> <!-- end .table-responsive-->
        <!--        </div>-->
        <!--    </div> <!-- end card-->
        <!--</div> <!-- end col -->
    </div>
    <!-- end row -->
    
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pb-2">
                    <form class="float-end row" method="GET">
                        <div class="col-sm-5">
                            <div class="from-group">
                                <input type="date" value="{{ request()->get('start_date') }}"
                                    class="form-control basic-datepicker" placeholder="Start Date" name="start_date">
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-5">
                            <div class="from-group">
                                <input type="date" value="{{ request()->get('end_date') }}"
                                    class="form-control basic-datepicker" placeholder="End Date" name="end_date">
                            </div>
                        </div>
                        <div class="col-sm-2 btn-group mb-2">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>

                    <h4 class="header-title mb-3">Download Analytics</h4>

                    <div dir="ltr">
                        <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col--> 
        
        <!-- payment analytics-->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pb-2">
                    <form class="float-end row" method="GET">
                        <div class="col-sm-5">
                            <div class="from-group">
                                <input type="date" value="{{ request()->get('start_date') }}"
                                    class="form-control basic-datepicker" placeholder="Start Date" name="start_date">
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-5">
                            <div class="from-group">
                                <input type="date" value="{{ request()->get('end_date') }}"
                                    class="form-control basic-datepicker" placeholder="End Date" name="end_date">
                            </div>
                        </div>
                        <div class="col-sm-2 btn-group mb-2">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>

                    <h4 class="header-title mb-3">Register Analytics</h4>

                    <div dir="ltr">
                        <div id="payment-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

   
</div> <!-- container -->
@endsection
@section('script')
 <!-- Plugins js-->
        <script src="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="{{asset('public/backEnd/')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="{{asset('public/backEnd/')}}/assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-pickers.init.js"></script>

    <script>

    var colors = ["#f1556c"],
    dataColors = $("#total-revenue").data("colors");
    dataColors && (colors = dataColors.split(","));
    var options = {
          series: [@if($total_delivery) {{round(($total_delivery*100)/$total_order)}} @endif],
          chart: {
             height: 242,
             type: "radialBar"
          },
          plotOptions: {
             radialBar: {
                hollow: {
                   size: "65%"
                }
             }
          },
          colors: colors,
          labels: ["Delivery"]
       },
        chart = new ApexCharts(document.querySelector("#total-revenue"), options);
        chart.render();
        // colors = ["#1abc9c", "#4a81d4"];
        // (dataColors = $("#sales-analytics").data("colors")) && (colors = dataColors.split(","));
        // options = {
        //   series: [{
        //       name: "Revenue",
        //       type: "column",
        //       data: [@foreach($monthly_sale as $sale) {{$sale->amount}}, @endforeach]
        //   }, {
        //       name: "Sales",
        //       type: "line",
        //       data: [@foreach($monthly_sale as $sale) {{$sale->amount}}, @endforeach]
        //   }],
        //   chart: {
        //       height: 378,
        //       type: "line",
        //   },
        //   stroke: {
        //       width: [2, 3]
        //   },
        //   plotOptions: {
        //       bar: {
        //          columnWidth: "50%"
        //       }
        //   },
        //   colors: colors,
        //   dataLabels: {
        //       enabled: !0,
        //       enabledOnSeries: [1]
        //   },
        //   labels: [@foreach($monthly_sale as $sale) {{date('d', strtotime($sale->date))}} + '-' + {{date('m', strtotime($sale->date))}}+ '-' + {{date('Y', strtotime($sale->date))}}, @endforeach],
        //   legend: {
        //       offsetY: 7
        //   },
        //   grid: {
        //       padding: {
        //          bottom: 20
        //       }
        //   },
        //   fill: {
        //       type: "gradient",
        //       gradient: {
        //          shade: "light",
        //          type: "horizontal",
        //          shadeIntensity: .25,
        //          gradientToColors: void 0,
        //          inverseColors: !0,
        //          opacityFrom: .75,
        //          opacityTo: .75,
        //          stops: [0, 0, 0]
        //       }
        //   },
        //   yaxis: [{
        //       title: {
        //          text: "Net Revenue"
        //       }
        //   }]
        // };
        // (chart = new ApexCharts(document.querySelector("#sales-analytics"), options)).render();
    </script>
    
    <script>
        $("#dash-daterange").flatpickr({
            altInput: !0,
            mode: "range",
        })
        @php
            $maxAmount = $monthly_sale->max('amount');
            $maxRounded = ceil($maxAmount / 100) * 100;
        @endphp
        var options = {
            series: [{
                data: [
                    @foreach ($monthly_sale as $sale)
                        {{ $sale->amount }},
                    @endforeach
                ] // Daily transaction prices
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true, // Horizontal bar chart
                    distributed: true, // Colorful bars
                    barHeight: '90%', // Adjust bar height for visual clarity
                }
            },
            dataLabels: {
                enabled: true, // Enable data labels on the bars
                formatter: function(val) {
                    return val + " BDT"; // Add price suffix (optional)
                },
                offsetX: 10, // Adjust position of labels
                style: {
                    fontSize: '12px',
                    colors: ["#000000"]
                }
            },
            xaxis: {
                min: 0, // Minimum value for the x-axis
                max: {{ $maxAmount }}, // Maximum value for the x-axis
                tickAmount: {{ $maxRounded / 100 }},
                title: {
                    text: 'Price (BDT)' // Label for x-axis
                },
                // labels: {
                //     formatter: function(value) {
                //         return value; // Show the value directly for every tick
                //     },

                // },
                categories: [
                    @foreach ($monthly_sale as $sale)
                        '{{ date('d', strtotime($sale->date)) }}-{{ date('m', strtotime($sale->date)) }}-{{ date('Y', strtotime($sale->date)) }}',
                    @endforeach
                ],
            },

        };

        var chart = new ApexCharts(document.querySelector("#sales-analytics"), options);
        chart.render();
    </script>
    
    <script>
       
        var options = {
            series: [{
                data: [
                    @foreach ($monthly_payment as $sale)
                        {{ $sale->amount }},
                    @endforeach
                ] // Daily transaction prices
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true, // Horizontal bar chart
                    distributed: true, // Colorful bars
                    barHeight: '90%', // Adjust bar height for visual clarity
                }
            },
            dataLabels: {
                enabled: true, // Enable data labels on the bars
                formatter: function(val) {
                    return val + " BDT"; // Add price suffix (optional)
                },
                offsetX: 10, // Adjust position of labels
                style: {
                    fontSize: '12px',
                    colors: ["#000000"]
                }
            },
            xaxis: {
                min: 0, 
                max: 500, 
                tickAmount: 5,
                title: {
                    text: 'Price (BDT)' 
                },
                
                categories: [
                    @foreach ($monthly_payment as $sale)
                        '{{ date('d', strtotime($sale->date)) }}-{{ date('m', strtotime($sale->date)) }}-{{ date('Y', strtotime($sale->date)) }}',
                    @endforeach
                ],
            },

        };

        var chart = new ApexCharts(document.querySelector("#payment-analytics"), options);
        chart.render();
    </script>
@endsection