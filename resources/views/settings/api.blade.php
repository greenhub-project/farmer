@extends('layouts.app')

@section('title', ' - API Credentials')

@section('content')
    <section id="settings">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Settings</div>
                        <div class="list-group">
                            <a href="{{ url('/settings/account') }}" class="list-group-item">
                                <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp;Account
                            </a>
                            <a href="{{ url('/settings/password') }}" class="list-group-item">
                                <i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp;Password
                            </a>
                            <a href="{{ url('/settings/api') }}" class="list-group-item active">
                                <i class="fa fa-cubes fa-fw" aria-hidden="true"></i>&nbsp;API Credentials
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div id="profile" class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp; API Credentials
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <th>API token</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><code>{{ $user->api_token }}</code></td>
                                    <td>
                                        <form method="post" action="{{ url('/settings/api') }}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-default" title="Generate new token">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection