@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <card-icon title="Devices"
                  icon="fa-mobile"
                  action="{{ url('api/v1/public/count/devices') }}"/>
        </div>
        <div class="col-md-3 col-sm-6">
            <card-icon title="Uploads"
                  icon="fa-cloud-upload"
                  action="{{ url('api/v1/public/count/samples') }}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <chart/>
        </div>
        <div class="col-md-6">
            <chart/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <card-stat title="Most popular brand"
                   action="{{ url('api/v1/public/count/samples') }}"/>
        </div>
    </div>
</div>
@endsection
