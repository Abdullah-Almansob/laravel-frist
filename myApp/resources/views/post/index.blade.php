@extends('layouts.Main')
@section('title', 'page post')
@section('content')
    <div class="container mt-4">



        <!-- عرض البوستات -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card shadow rounded-3 h-100">
                        <!-- صورة بروفايل -->
                        <div class="card-header bg-light d-flex align-items-center gap-2">
                            @if ($post->user && $post->user->profile_image)
                                <img src="{{ asset('storage/' . $post->user->profile_image) }}" alt="Profile Image"
                                    width="50" class="rounded-circle">
                            @else
                                <img src="{{ asset('storage/profile_images/default-profile.png') }}" alt="Default Profile"
                                    width="50" class="rounded-circle">
                            @endif


                            <div>
                                <strong>{{ $post->user->name ?? 'مستخدم مجهول' }}</strong><br>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>

                        <!-- محتوى البوست -->
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                        </div>
                        @auth
                            @if (auth()->id() === $post->user_id || auth()->user()->is_admin)
                                <div class="card-footer bg-white border-top d-flex justify-content-between gap-2">
                                    <a href="{{ route('post.edit', $post->id) }}"
                                        class="btn btn-sm btn-warning rounded-pill px-3">
                                        تعديل
                                    </a>
                                    <button type="button" class="btn btn-danger btnDelete btn-sm rounded-pill px-3"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal" data-post-id="{{ $post->id }}">
                                        حذف
                                    </button>
                                </div>
                            @endif
                        @endauth

                    </div>
                </div>
            @endforeach
        </div>

        <!-- ✅ مودال تأكيد الحذف -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')

                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                        </div>

                        <div class="modal-body">
                            هل أنت متأكد أنك تريد حذف هذا البوست؟
                        </div>
                        <pre id="formAction"></pre>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-danger">تأكيد الحذف</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>




    @endsection



















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    </body>

    </html>
