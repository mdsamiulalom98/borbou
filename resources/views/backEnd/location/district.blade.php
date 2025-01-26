@extends('backEnd.layouts.master')
@section('title','Active Review')
@section('css')
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/public/backEnd/')}}/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Active Review</h4>
            </div>
        </div>
    </div>       
    <!-- end page title --> 
    <form action="{{ route('location.assign_district') }}" method="POST">
        @csrf
    <div class="row">
        <div class="col-sm-12 d-flex">
            <div class="form-group" style="width: 250px; margin-right: 15px">
                 <select class="form-control select2-multiple" name="district_id" data-toggle="select2"  data-placeholder="Choose ...">
                    <optgroup >
                        <option value="">Select..</option>
                        @foreach($data_districts as $value)
                        <option @if(Session::get('next_id') == $value->id) selected @endif value="{{$value->id}}">{{$value->title}}</option>
                        @endforeach
                    </optgroup>
                </select>
                @error('district_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit">Submit</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:2%"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input checkall" value=""></label>
                                <th>SL</th>
                                <th>Name</th>
                                <th>District</th>
                                <th>Division</th>
                            </tr>
                        </thead>
                    
                    
                        <tbody>
                            @foreach($show_data as $key=>$value) 
                            @if($value->id > 8)   
                            @php
                             $division =  App\Models\Location::where('division_id','=','0')->where('id',$value->division_id)->first();
                             $district = App\Models\Location::where('district_id','=','0')->where('id',$value->district_id)->first();
                            @endphp                        
                            <tr>
                                <td>
                                    <label for="checkboxItem{{$key}}" style="padding: 6px 10px;background-color: red;">
                                        <input type="checkbox" id="checkboxItem{{$key}}" class="checkbox" name="item[]" value="{{$value->id}}">
                                    </label>
                                </td>
                                <td>{{$value->id}}</td>
                                <td>{{$value->title}}</td>
                                <td>{{ $district?$district->title:''}}</td>
                                <td>{{ $division?$division->title:''}}</td>
                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
     
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".checkall").on('change',function(){
      $(".checkbox").prop('checked',$(this).is(":checked"));
    });
</script>
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
@endsection