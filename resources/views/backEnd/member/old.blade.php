@extends('backEnd.layouts.master')
@section('title','Old Member Manage')

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
                <h4 class="page-title">Old Member Manage</h4>
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
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <input type="date" value="{{request()->get('end_date')}}"  class="form-control basic-datepicker" placeholder="End Date" name="end_date">
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('gender') is-invalid @enderror" value="{{ old('gender') }}" name="gender" data-toggle="select2"   data-placeholder="Gender" required>
                                    <optgroup >
                                        <option value="">Select..</option>
                                        <option value="1" @if(request()->get('gender')==1) selected @endif>Male</option>
                                        <option value="2" @if(request()->get('gender')==2) selected @endif >Female</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('marital_status') is-invalid @enderror" value="{{ old('marital_status') }}" name="marital_status" data-toggle="select2"   data-placeholder="Marital Status" >
                                    <optgroup >
                                        <option value="">Marital Status</option>
                                        @foreach ($maritalstatuses as $maritalstatus)
                                        <option value="{{ $maritalstatus->id }}" @if(request()->get('marital_status')==$maritalstatus->id) selected @endif>{{ $maritalstatus->title }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                       
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('education') is-invalid @enderror" value="{{ old('education') }}" name="education" data-toggle="select2" id="education"  data-placeholder="Education">
                                    <option value="">Education</option>
                                    @foreach($edulevels as $edulevel)
                                    <option value="{{ $edulevel->id }}" {{request()->get('education')==$edulevel->id?'selected':''}}>{{ $edulevel->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('degree') is-invalid @enderror" value="{{ old('degree') }}" name="degree" data-toggle="select2" id="degree"  data-placeholder="Degree">
                                    <option value="">Degree</option>
                                    @foreach($alldegrees as $degree)
                                    <option value="{{ $degree->id }}" {{request()->get('degree')==$degree->id?'selected':''}}>{{ $degree->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('profession') is-invalid @enderror" value="{{ old('profession') }}" name="profession" data-toggle="select2"   data-placeholder="Profession">
                                    <optgroup >
                                        <option value="">Profession</option>
                                        @foreach($professions as $profession)
                                            <option value="{{ $profession->id }}" {{request()->get('profession')==$profession->id?'selected':''}}>{{ $profession->title}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('working') is-invalid @enderror" value="{{ old('working') }}" name="working" data-toggle="select2"   data-placeholder="working">
                                    <optgroup >
                                        <option value="">working</option>
                                        @foreach($workings as $working)
                                            <option value="{{ $working->id }}" {{request()->get('working')==$working->id?'selected':''}}>{{ $working->title}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('country') is-invalid @enderror" value="{{ old('country') }}" name="country" data-toggle="select2"   data-placeholder="Country">
                                    <optgroup >
                                    <option value="">Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"{{request()->get('country')==$country->id?'selected':''}}>{{ $country->title }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('division') is-invalid @enderror" value="{{ old('division') }}" id="division_id" name="division" data-toggle="select2"   data-placeholder="Division" >
                                    <optgroup >
                                        <option value="">Division</option>
                                        @foreach($divisions as $location)
                                            <option value="{{ $location->id }}" {{request()->get('division')==$location->id?'selected':''}}>{{ $location->title }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('district') is-invalid @enderror" value="{{ old('district') }}" id="district_id" name="district" data-toggle="select2"   data-placeholder="District" >
                                    <optgroup >
                                        <option value="">District</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{request()->get('district')==$district->id?'selected':''}}>{{ $district->title }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('upazila') is-invalid @enderror" value="{{ old('upazila') }}" id="upazila_id" name="upazila" data-toggle="select2"   data-placeholder="Upazila" >
                                    <optgroup >
                                        <option value="">Upazila</option>
                                        @foreach($upazilas as $upazila)
                                            <option value="{{ $upazila->id }}" {{request()->get('upazila')==$upazila->id?'selected':''}}>{{ $upazila->title }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('religion') is-invalid @enderror" value="{{ old('religion') }}" name="religion" data-toggle="select2"   data-placeholder="Religion" >
                                    <optgroup >
                                        <option value="">Religion</option>
                                        @foreach($religions as $religion)
                                            <option value="{{ $religion->id }}" {{request()->get('religion')==$religion->id?'selected':''}}>{{ $religion->title}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <select class="form-control select2 @error('status') is-invalid @enderror" value="{{ old('status') }}" name="status" data-toggle="select2"   data-placeholder="Status" >
                                    <optgroup >
                                        <option value="">Status</option>
                                            <option value="1" @if(request()->get('status')==1) selected @endif>Active</option>
                                            <option value="2" @if(request()->get('status')==2) selected @endif>Inactive</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-3">
                            <div class="from-group">
                                <button class="btn btn-success">Filter</button>
                                <a href="{{ route('members.old') }}" class="btn btn-secondary">Clear</a>
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
                            <th>OTP</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                
                
                    <tbody>
                        @foreach($show_data as $key=>$value)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$value->created_at?->format('d F Y')}} <br> {{$value->created_at?->format('h : i A')}}</td>
                            <td>{{$value->id}}</td>
                            <td>{{$value->fullName}}</td>
                            <td>{{$value->phoneNumber}}</td>
                            <td>@if($value->verifyToken==1)<span style="color: green">Verified</span>@else<span style="color: red">{{$value->verifyToken}}</span>@endif</td>
                            <td>@if($value->publish==1)<span class="badge bg-soft-success text-success">Publish</span> @else <span class="badge bg-soft-danger text-danger">Unpublish</span> @endif</td>
                            <td>
                                <div class="button-list">
                                    <form method="post" action="{{route('members.active')}}" class="d-inline">
                                       @csrf
                                       <input type="hidden" value="{{$value->id}}" name="hidden_id">        
                                       <button type="button" class="btn btn-xs  btn-danger waves-effect waves-light change-confirm"><i class="fe-thumbs-down"></i></button>
                                    </form>
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