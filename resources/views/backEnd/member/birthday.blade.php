@extends('backEnd.layouts.master')
@section('title','Members Birthday')
@section('css')
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backEnd')}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('public/backEnd')}}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    @if (!request()->routeIs('members.birthdaytoday'))
                        <a href="{{ route('members.birthdaytoday') }}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Today's Birthday</a>
                        @else
                        <a href="{{ route('members.birthday') }}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Member Birthday</a>
                    @endif
                </div>
                <h4 class="page-title">Member's Birthday</h4>
            </div>
        </div>
    </div>       
    <!-- end page title --> 
   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="sort-form">
                    <form action="" class="row">
                        <h4>Total - {{$show_data->count()}}</h4>
                        <div class="col-sm-3">
                            <div class="from-group">
                                <input type="date" value="{{request()->get('start_date')}}"  class="form-control basic-datepicker" placeholder="Start Date" name="start_date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="from-group">
                                <button class="btn btn-success">Filter</button>
                            </div>
                        </div>
                        <!-- col end -->
                    </form>
                </div>
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Time & Date</th>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Birthday</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                
                
                    <tbody>
                        @foreach($show_data as $key=>$value)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$value->created_at->format('d F Y')}} <br> {{$value->created_at->format('h : i a')}}</td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->fullName}}</td>
                            <td>{{$value->phoneNumber}}</td>
                            <td>{{date('F d, Y', strtotime($value->basicinfo?$value->basicinfo->dob:''))}}</td>
                            <td>@if($value->status==1)<span class="badge bg-soft-success text-success">Active</span> @else <span class="badge bg-soft-danger text-danger">Inactive</span> @endif</td>
                            <td>
                                <div class="button-list">
                                    <a href="{{route('members.profile',['id'=>$value->id])}}" class="btn btn-xs btn-blue waves-effect waves-light"><i class="fe-eye"></i></a>
                                    <a href="{{route('members.edit',$value->id)}}" class="btn btn-xs btn-primary waves-effect waves-light"><i class="fe-edit-1"></i></a>
                                    @if($value->status == 1)
                                    <form method="post" action="{{route('members.inactive')}}" class="d-inline"> 
                                    @csrf
                                    <input type="hidden" value="{{$value->id}}" name="hidden_id">       
                                    <button type="button" class="btn btn-xs  btn-success waves-effect waves-light change-confirm"><i class="fe-thumbs-down"></i></button></form>
                                    @else
                                    <form method="post" action="{{route('members.active')}}" class="d-inline">
                                        @csrf
                                    <input type="hidden" value="{{$value->id}}" name="hidden_id">        
                                    <button type="button" class="btn btn-xs  btn-danger waves-effect waves-light change-confirm"><i class="fe-thumbs-down"></i></button></form>
                                    @endif


                                    <form method="post" action="{{route('members.adminlog')}}" class="d-inline" target="_blank">
                                        @csrf
                                    <input type="hidden" value="{{$value->id}}" name="member_id">  
                                    <button type="submit" onclick="confirm('do you want to login?')" class="btn btn-xs btn-pink waves-effect waves-light " title="Login as customer"><i class="fe-log-in"></i></button></form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
 
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
   </div>
</div>
@endsection


@section('script')
<!-- third party js -->
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{asset('/public/backEnd/')}}/assets/js/pages/datatables.init.js"></script>
<!-- third party js ends -->
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-validation.init.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/libs/select2/js/select2.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-advanced.init.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-pickers.init.js"></script>
@endsection