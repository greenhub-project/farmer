@extends('layouts.app')

@section('title', ' - Account')

@section('content')
<section id="settings">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    <a href="{{ url('/settings/account') }}" class="list-group-item active">
                        <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp;Account
                    </a>
                    <a href="{{ url('/settings/password') }}" class="list-group-item">
                        <i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp;Password
                    </a>
                    <a href="{{ url('/settings/api') }}" class="list-group-item">
                        <i class="fa fa-code-fork fa-fw" aria-hidden="true"></i>&nbsp;API Credentials
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <form method="post" action="{{ url('/settings/profile') }}">
                    {{ csrf_field() }}
                    <div id="profile" class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp; Account
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-7 col-xs-10">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Save changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection