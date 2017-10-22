@extends('layouts.app')

@section('title', ' - Samples')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>Samples</h1>
                    <search-box
                            action="{{ route('samples.index') }}"/>
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
                        <th>Created at</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($samples as $sample)
                        <tr>
                            <td>{{ $sample->id }}</td>
                            <td>{{ $sample->battery_state }}</td>
                            <td>{{ $sample->battery_level }}</td>
                            <td>{{ $sample->memoryActive() }}</td>
                            <td>{{ $sample->network_status }}</td>
                            <td>
                                @if($sample->screen_on)
                                    <i class="fa fa-check-circle text-success"></i>
                                @else
                                    <i class="fa fa-times-circle text-danger"></i>
                                @endif
                            </td>
                            <td>{{ $sample->timezone }}</td>
                            <td>{{ $sample->timestamp }}</td>
                            <td>
                                <a class="btn btn-xs btn-info"
                                   href="{{ route('samples.show', $sample->id) }}"
                                   title="See details">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $samples->appends(Request::except('page'))->links() !!}
            </div>
        </div>
    </div>
@endsection
