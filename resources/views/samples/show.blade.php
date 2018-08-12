@extends('layouts.app')

@section('title', ' - Sample #' . $sample->id)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>Sample #{{ $sample->id }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <ul class="list-group list-group--spaced">
                                <li class="list-group-item">
                                    <h3 class="list-group-item-heading">Device</h3>
                                </li>
                                <li class="list-group-item">
                                    Brand
                                    <div>{{ $sample->device->brand }}</div>
                                </li>
                                <li class="list-group-item">
                                    Model
                                    <div>{{ $sample->device->model }}</div>
                                </li>
                                <li class="list-group-item">
                                    Manufacturer
                                    <div>{{ $sample->device->manufacturer }}</div>
                                </li>
                                <li class="list-group-item">
                                    OS version
                                    <div>{{ $sample->device->os_version }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <ul class="list-group list-group--spaced">
                                <li class="list-group-item">
                                    <h3 class="list-group-item-heading">Details</h3>
                                </li>
                                <li class="list-group-item">
                                    App version
                                    <div>{{ $sample->app_version }}</div>
                                </li>
                                <li class="list-group-item">
                                    Database version
                                    <div>{{ $sample->database_version }}</div>
                                </li>
                                <li class="list-group-item">
                                    Timestamp
                                    <div>{{ $sample->timestamp }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <chart-panel
                        label="Samples received last 7 days"
                        action="{{ url('/stats/weekly/samples') }}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                            <i class="fa fa-info-circle fa-fw"></i>
                            Summary
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#battery" aria-controls="battery" role="tab" data-toggle="tab">
                            <i class="fa fa-battery-three-quarters fa-fw"></i>
                            Battery
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#network" aria-controls="network" role="tab" data-toggle="tab">
                            <i class="fa fa-wifi fa-fw"></i>
                            Network
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#cpu" aria-controls="cpu" role="tab" data-toggle="tab">
                            <i class="fa fa-bolt fa-fw"></i>
                            CPU
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#settings" aria-controls="cpu" role="tab" data-toggle="tab">
                            <i class="fa fa-wrench fa-fw"></i>
                            Settings
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="summary">
                        <div class="page-header">
                            <h3>General information</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Battery state</th>
                                <th>Battery level</th>
                                <th>Memory active</th>
                                <th>Network status</th>
                                <th>Screen on</th>
                                <th>Timezone</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $sample->id }}</td>
                                    <td>{{ $sample->battery_state }}</td>
                                    <td>{{ $sample->battery_level }}</td>
                                    <td>{{ $sample->formattedMemoryActive() }}</td>
                                    <td>{{ $sample->network_status }}</td>
                                    <td>
                                        @if($sample->screen_on)
                                            <i class="fa fa-check-circle text-success"></i>
                                        @else
                                            <i class="fa fa-times-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <td>{{ $sample->timezone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="battery">
                        <div class="page-header">
                            <h3>Battery details</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Charger</th>
                                <th>Health</th>
                                <th>Voltage</th>
                                <th>Temperature</th>
                                <th>Capacity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $sample->batteryDetails->id }}</td>
                                <td>{{ $sample->batteryDetails->charger }}</td>
                                <td>{{ $sample->batteryDetails->health }}</td>
                                <td>{{ $sample->batteryDetails->voltage }}</td>
                                <td>{{ $sample->batteryDetails->temperature }}</td>
                                <td>{{ $sample->batteryDetails->capacity }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="network">
                        <div class="page-header">
                            <h3>Network details</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Network type</th>
                                <th>Network operator</th>
                                <th>Sim operator</th>
                                <th>MCC</th>
                                <th>MNC</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $sample->id }}</td>
                                <td>{{ $sample->networkDetails->network_type }}</td>
                                <td>{{ $sample->networkDetails->network_operator }}</td>
                                <td>{{ $sample->networkDetails->sim_operator }}</td>
                                <td>{{ $sample->networkDetails->mcc }}</td>
                                <td>{{ $sample->networkDetails->mnc }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="page-header">
                            <h3>Mobile data</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mobile network type</th>
                                <th>Mobile data status</th>
                                <th>Mobile data activity</th>
                                <th>Roaming</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $sample->id }}</td>
                                <td>{{ $sample->networkDetails->mobile_network_type }}</td>
                                <td>{{ $sample->networkDetails->mobile_data_status }}</td>
                                <td>{{ $sample->networkDetails->mobile_data_activity }}</td>
                                <td>{{ $sample->networkDetails->roaming }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="page-header">
                            <h3>Wifi</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Wifi status</th>
                                <th>Wifi signal strength</th>
                                <th>Wifi link speed</th>
                                <th>Wifi AP status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $sample->id }}</td>
                                <td>{{ $sample->networkDetails->wifi_status }}</td>
                                <td>{{ $sample->networkDetails->wifi_signal_strengh }}</td>
                                <td>{{ $sample->networkDetails->wifi_link_speed }}</td>
                                <td>{{ $sample->networkDetails->wifi_ap_status }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="cpu">
                        <div class="page-header">
                            <h3>CPU Status</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Usage</th>
                                <th>Up time</th>
                                <th>Sleep time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $sample->cpuStatus->id }}</td>
                                <td>{{ $sample->cpuStatus->usage }}</td>
                                <td>{{ $sample->cpuStatus->up_time }}</td>
                                <td>{{ $sample->cpuStatus->sleep_time }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="settings">
                        <div class="page-header">
                            <h3>Preferences configuration</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Bluetooth</th>
                                <th>Location</th>
                                <th>Power saver</th>
                                <th>Flashlight</th>
                                <th>NFC</th>
                                <th>Unknown sources</th>
                                <th>Developer mode</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $sample->settings->id }}</td>
                                <td>
                                    @if($sample->settings->bluetooth_enabled)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->settings->location_enabled)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->settings->power_saver_enabled)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->settings->flashlight_enabled)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->settings->nfc_enabled)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->settings->unknown_sources)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($sample->settings->developer_mode)
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
