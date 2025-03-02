@extends('layouts.app')
@section('content')
<h1>Welcome to the Admin Dashboard</h1>
<p>Use the navigation below to manage the data.</p>
<ul>
    <li><a href="{{ route('users.index') }}">Manage Users</a></li>
    <li><a href="{{ route('courses.index') }}">Manage Courses</a></li>
</ul>
@endsection