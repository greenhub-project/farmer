@extends('layouts.app')

@section('title', ' - API Credentials')

@section('content')
    <section id="settings">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="list-group">
                        <a href="{{ url('/settings/profile') }}" class="list-group-item">
                            <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp;Profile
                        </a>
                        <a href="{{ url('/settings/password') }}" class="list-group-item">
                            <i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp;Change password
                        </a>
                        <a href="{{ url('/settings/api') }}" class="list-group-item active">
                            <i class="fa fa-code-fork fa-fw" aria-hidden="true"></i>&nbsp;API Credentials
                        </a>
                    </div>
                </div>
                <div class="col-sm-9">
                    <form method="post" action="{{ url('/settings/api') }}">
                        {{ csrf_field() }}
                        <div id="profile" class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-code-fork fa-fw" aria-hidden="true"></i>&nbsp;API Credentials
                            </div>
                            <table class="table table-responsive hidden-sm hidden-xs">
                                <thead>
                                <tr>
                                    <th>API Token</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><code class="api-token">{{ $user->api_token }}</code></td>
                                    <td>
                                        <button class="btn btn-default btn-sm clipboard"
                                                type="button" data-clipboard-text="{{ $user->api_token }}">
                                            <i class="fa fa-copy" aria-hidden="true"></i>&nbsp;Copy to clipboard
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="panel-body visible-sm visible-xs">
                                <label for="clipboard-text">API Token</label>
                                <div class="input-group">
                                    <input id="clipboard-text" type="text" class="form-control" value="{{ $user->api_token }}" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default clipboard" type="button"
                                                data-clipboard-target="#clipboard-text" title="Copy to clipboard">
                                            <i class="fa fa-copy" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-refresh"></i> Generate new token
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection