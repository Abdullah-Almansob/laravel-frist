@extends('layouts.main')
@section('title', 'Create post')
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">✍️ إنشاء بوست جديد</h5>
                    </div>

                    <div class="card-body">

                        <!-- عرض اسم المستخدم -->
                        @auth
                            <div class="mb-3">
                                <label class="form-label fw-bold">اسم المستخدم:</label>
                                <div class="form-control-plaintext">{{ Auth::user()->name }}</div>
                            </div>
                        @endauth

                        <!-- نموذج البوست -->
                        <form method="POST" action="{{ route('post.store') }}">
                            @csrf

                            <!-- العنوان -->
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان البوست</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>

                            <!-- الوصف -->
                            <div class="mb-3">
                                <label for="description" class="form-label">وصف البوست</label>
                                <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
                            </div>

                            <!-- user_id مخفي -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <!-- زر الإرسال -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">✅ نشر البوست</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
