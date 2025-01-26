@extends('backEnd.layouts.master') 
@section('title','Location Create') 
@section('css')
<link href="{{asset('public/backEnd')}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{route('location.index')}}" class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Manage</a>
                </div>
                <h4 class="page-title">Location Create</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('location.store')}}" method="POST" class="row" data-parsley-validate="" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Location Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title') }}" id="title" />
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col-end -->
                        <div class="col-sm-6">
                          <div class="form-group mb-3">
                            <label for="division_id" class="form-label">Division</label>
                             <select  id="division_id" class="form-control select2" name="division_id" data-toggle="select2"  data-placeholder="Choose ...">
                                <optgroup >
                                    <option value="">Select..</option>
                                    @foreach($divisions as $value)
                                    <option value="{{$value->id}}">{{$value->title}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('division_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- col end -->
                        <div class="col-sm-6">
                          <div class="form-group mb-3">
                            <label for="district_id" class="form-label">District</label>
                             <select id="district_id" class="form-control select2" name="district_id" data-toggle="select2"  data-placeholder="Choose ...">
                                <optgroup >
                                    <option value="">Select..</option>
                                </optgroup>
                            </select>
                            @error('district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-12">
                        <div class="form-group mb-3">
                            <label for="serial" class="form-label">Location Serial</label>
                            <input type="text" class="form-control @error('serial') is-invalid @enderror" name="serial" value="{{old('serial') }}" id="serial" />
                            @error('serial')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- col-end -->
                    <!-- col end -->
                        <div>
                            <input type="submit" class="btn btn-success" value="Submit" />
                        </div>
                    </form>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->
    </div>
</div>
@endsection 
@section('script')
<script src="{{asset('public/backEnd/')}}/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-validation.init.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/libs/select2/js/select2.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-advanced.init.js"></script>
@endsection
