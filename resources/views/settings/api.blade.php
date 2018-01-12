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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-cubes fa-fw" aria-hidden="true"></i>&nbsp; API Credentials
                        </div>
                        @verified
                        <api-form
                                title="Generate new token"
                                token="{{ $user->api_token }}"
                                action="{{ url('/settings/api') }}"/>
                        @else
                        <div class="panel-body">
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Please verify your email to see your API token!
                            </div>
                        </div>
                        @endverified
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection