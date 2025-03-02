@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Course</h1>

        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Course Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $course->title) }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $course->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="professor_ids">Professors</label>
                <select name="professor_ids[]" multiple class="form-control">
                    @foreach ($professors as $professor)
                        <option value="{{ $professor->id }}" {{ in_array($professor->id, old('professor_ids', $course->professors->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $professor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection
