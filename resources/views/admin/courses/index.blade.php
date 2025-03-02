@extends('layouts.app')

@section('content')
    <h1>Manage Courses</h1>
    <a href="{{ route('admin.courses.create') }}">Add New Course</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Instructor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->category->name }}</td>
                    <td>{{ $course->professor->name }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Form -->
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
