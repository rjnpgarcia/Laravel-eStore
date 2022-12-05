@extends('layouts.app')
@section('content')  
<h1>List of Users</h1>


@empty($users)
<div class="alert alert-warning">
    The list of products is empty
</div>

@else
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Email Verified at</th>
            <th>Admin since</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->email_verified_at ?? 'Not Verified'}}</td>
                <td>{{optional($user->admin_since)->diffForHumans() ?? 'Not Admin'}}</td>
                <td>
                    <form method="POST" action="{{ route('users.toggleAdmin', ['user' => $user->id]) }}">
                        @csrf
                        <button class="btn btn-link">{{$user->isAdmin() ? 'Remove from' : 'Make'}} Admin</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
