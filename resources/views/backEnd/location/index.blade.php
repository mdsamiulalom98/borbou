@extends('backEnd.layouts.master') 
@section('title','Location Manage') 
@section('css')
<link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endsection 
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('location.create') }}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Create</a>
                    <a href="{{ route('location.divisions') }}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Division</a>
                    <a href="{{ route('location.districts') }}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">District</a>
                </div>
                <h4 class="page-title">Location Manage</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Division</th>
                                <th>District</th>
                                <th>Top</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($show_data as $key=>$value)
                            @php
                             $division =  App\Models\Location::where('division_id','=','0')->where('id',$value->division_id)->first();
                             $district = App\Models\Location::where('district_id','=','0')->where('id',$value->district_id)->first();
                            @endphp
                            <tr style="vertical-align: middle;">
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $division?$division->title:''}}</td>
                                <td>{{ $district?$district->title:''}}</td>
                                <td>{{ $value->serial == 1 ? 'Top' : '' }}</td>
                                <td>
                                    <div class="button-list">
                                        <a href="{{ route('location.edit',$value->id) }}" class="btn btn-xs btn-primary waves-effect waves-light"><i class="fe-edit-1"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
</div>
@endsection 
@section('script')
<!-- third party js -->
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{ asset('/public/backEnd/') }}/assets/js/pages/datatables.init.js"></script>
<!-- third party js ends -->
@endsection
