@extends('layouts.app')

@section('title', ' - Members')

@section('content')
    <div class="container">
        <div class="row">

        </div>
        <div class="row">
            @if($users->count() > 0)
                <div class="page-header">
                    <h1>Members & privileges</h1>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Verified</th>
                        @foreach($roles as $role)
                            <th class="text-capitalize">{{ $role->name }}</th>
                        @endforeach
                        <th>Joined on</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->verified)
                                    <i class="fa fa-check-circle text-success"></i>
                                @else
                                    <i class="fa fa-times-circle text-danger"></i>
                                @endif
                            </td>
                            @foreach($roles as $role)
                                <td>
                                    @if($user->hasRole($role->name))
                                        <i class="fa fa-check-circle text-success"></i>
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                            @endforeach
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->appends(Request::except('page'))->links() }}
            @else
                <p class="text-primary">There are no members</p>
            @endif
        </div>
    </div>
@endsection