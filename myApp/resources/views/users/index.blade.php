@extends('layouts.Main')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center text-primary fw-bold mb-4">👥 إدارة المستخدمين</h2>

        <div class="row g-4">
            @foreach ($users as $user)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 p-3 position-relative h-100">

                        {{-- صورة بروفايل --}}
                        <div class="text-center mb-3">
                            <img src="{{ $user->image_path ? asset('storage/' . $user->image_path) : asset('storage/images/default_image.png') }}"
                                alt="صورة المستخدم" class="rounded-circle shadow"
                                style="width: 90px; height: 90px; object-fit: cover;">
                        </div>

                        {{-- معلومات المستخدم --}}
                        <div class="text-center">
                            <h5 class="fw-bold">{{ $user->name }}</h5>
                            <p class="text-muted mb-1"><strong>📧</strong> {{ $user->email }}</p>
                            <p><strong>📝 عدد المنشورات:</strong> {{ $user->posts->count() }}</p>
                            <p>
                                <strong>📊 نسبة المنشورات:</strong>
                                @if ($totalPosts > 0)
                                    {{ number_format(($user->posts->count() / $totalPosts) * 100, 1) }}%
                                @else
                                    0%
                                @endif
                            </p>

                            {{-- شارة أدمن إن كان كذلك --}}
                            @if ($user->is_admin)
                                <span class="badge bg-success">أدمن</span>
                            @endif
                        </div>

                        {{-- الإجراءات --}}
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            {{-- زر تعيين كأدمن --}}
                            @if (!$user->is_admin)
                                <form action="{{ route('users.makeAdmin', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm">
                                        👑 ترقية
                                    </button>
                                </form>
                            @endif

                            {{-- حذف (لا يُسمح بحذف الأدمن) --}}
                            @if (!$user->is_admin)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">🗑️ حذف</button>
                                </form>
                            @endif
                            <a href="{{ route('users.posts', $user->id) }}" class="btn btn-outline-primary btn-sm mt-2">
                                📂 عرض المنشورات
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
