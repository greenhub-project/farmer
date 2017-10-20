@extends('layouts.app')

@section('title', ' - Account')

@section('content')
<section id="settings">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings</div>
                    <div class="list-group">
                        <a href="{{ url('/settings/account') }}" class="list-group-item active">
                            <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp;Account
                        </a>
                        <a href="{{ url('/settings/password') }}" class="list-group-item">
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
                        <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp; Account
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{ url('/settings/account') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
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