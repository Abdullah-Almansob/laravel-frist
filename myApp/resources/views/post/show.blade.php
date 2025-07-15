@extends('layouts.main')
@section('title', 'one post')
@section('content')
    <div class="card ">
        <div class="card-header mt-10 bg-secondary">
            <img src="{{ $post->image_path ? asset('storage/' . $post->image_path) : asset('storage/images/default_image.png') }}"
                class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" alt="صورة البوست">

        </div>
        <div class="card-body">
            <p class="card-text"> No:-{{ $post['id'] }}</p>
            <h5 class="card-title text-primary">Title:-{{ $post['title'] }}</h5>
            <p class="card-text"> Description:-{{ $post['description'] }}</p>

        </div>
    </div>
    <div class="card">
        <div class="">

        </div>
        <div class="card-body">
            <h5 class="card-title text-primary">Name:-{{ $post->user->name ?? 'غير معروف' }}</h5>
            <p class="card-text">Email:-{{ $post->user->email ?? '' }}</p>
            <p class="card-text">Time:-{{ $post->created_at ?? '' }}</p>

        </div>
    </div>
@endsection


























<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


</body>

</html>
