@extends('layouts.app')

@section('title', ' - Password')

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
                            <a href="{{ url('/settings/password') }}" class="list-group-item active">
                                <i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp;Password
                            </a>
                            <a href="{{ url('/settings/api') }}" class="list-group-item">
                                <i class="fa fa-cubes fa-fw" aria-hidden="true"></i>&nbsp;API Credentials
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp; Password
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="post" action="{{ url('/settings/password') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="new_password" class="col-sm-3 control-label">New password</label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repeat_password" class="col-sm-3 control-label">Repeat password</label>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-floppy-o"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection