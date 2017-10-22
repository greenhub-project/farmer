@extends('layouts.app')

@section('title', ' - Devices')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>Devices</h1>
                    <search-box
                        action="{{ route('devices.index') }}"/>
                </div>
                @if($devices->count() > 0)
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Manufacturer</th>
                            <th>OS version</th>
                            <th>Active</th>
                            <th>Created at</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($devices as $device)
                            <tr>
                                <td>{{ $device->id }}</td>
                                <td>{{ $device->brand }}</td>
                                <td>{{ $device->model }}</td>
                                <td>{{ $device->manufacturer }}</td>
                                <td>{{ $device->os_version }}</td>
                                <td>
                                    @if($device->isActive())
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>{{ $device->created_at }}</td>
                                <td>
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('devices.show', $device->id) }}"
                                       title="See details">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $devices->links() }}
                @else
                    <p class="text-primary">There are no matching rows</p>
                @endif
            </div>
        </div>
    </div>
@endsection
