@extends('layouts.Main')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">📂 منشورات {{ $user->name }}</h2>

        @if ($user->posts->isEmpty())
            <p class="text-center text-muted">لا توجد منشورات لهذا المستخدم.</p>
        @else
            <div class="row g-4">
                @foreach ($user->posts as $post)
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                                <small class="text-muted">تاريخ النشر: {{ $post->created_at->format('Y-m-d') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
