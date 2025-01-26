@extends('frontEnd.layouts.master') 
@section('title','') 
@section('content')
@include('frontEnd.layouts.navigation') 
@include('frontEnd.layouts.pagenavigation') 
<section class="createpage-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="page-description">
                            {!! $page->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection