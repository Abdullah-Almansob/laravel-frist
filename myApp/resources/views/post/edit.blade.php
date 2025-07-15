@extends('layouts.main')
@section('title', 'post-edit')
@section('content')
    <form method="POST" action="{{ route('post.update', $post->id) }}"enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input name="title" value="{{ $post->title }}" class="form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $post->description }}</textarea>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 text-center mb-4">
                <h5>الصورة الحالية</h5>
                <div class="border rounded p-3 bg-light">
                    <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : asset('images/default_image.png') }}"
                        class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <h5>تحميل صورة جديدة</h5>
                <div class="mb-3">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="border rounded p-3 bg-light">
                    <img id="previewImage" class="rounded-circle img-fluid"
                        style="width: 150px; height: 150px; object-fit: cover;" src="#" alt="معاينة الصورة الجديدة"
                        hidden>
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <select name="user_name" class="form-select">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Edit post</button>

    </form>

@endsection
