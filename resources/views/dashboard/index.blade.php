@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <stats-panel
                title="Samples Received"
                action="{{ url('/stats/count/samples') }}"/>
        </div>
        <div class="col-md-4">
            <stats-panel
                title="Devices Installs"
                action="{{ url('/stats/count/devices') }}"/>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-lg-12">
                    <live-counter-panel
                            title="Samples"
                            action="{{ url('/stats/total/samples') }}"/>
                </div>
                <div class="col-lg-12">
                    <live-counter-panel
                            title="Devices"
                            action="{{ url('/stats/total/devices') }}"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <chart-panel
                    label="Samples received last 7 days"
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
