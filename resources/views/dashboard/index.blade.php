@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <stats-panel
                title="Uploads Received"
                action="{{ url('/stats/count/samples') }}"/>
        </div>
        <div class="col-md-4">
            <stats-panel
                title="Devices Installs"
                action="{{ url('/stats/count/devices') }}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <chart-panel
                    label="Uploads received last 7 days"
                    action="{{ url('/stats/weekly/samples') }}"/>
        </div>
        <div class="col-md-6">
            <chart-panel
                    label="Devices installs last 7 days"
                    action="{{ url('/stats/weekly/devices') }}"/>
        </div>
    </div>
</div>
@endsection
