<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- شعار الموقع -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('storage/images/logo.png') }}" class="rounded-circle"
                style="width: 35px; height: 35px; object-fit: cover;" alt="Logo">
            <span class="fw-bold text-primary" style="font-family: 'Cairo', sans-serif; font-size: 20px;">مدونتي</span>
        </a>

        <!-- روابط التنقل في المنتصف -->
        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav mb-2 mb-lg-0" style="font-family: 'Cairo', sans-serif;">
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="{{ route('post.index') }}">الرئيسية</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-semibold text-dark" href="{{ route('post.create') }}">بوست جديد</a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-dark" href="{{ route('register') }}">مستخدم جديد</a>
                </li>

                @auth
                    @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark" href="{{ route('users.index') }}">إدارة المستخدمين</a>
                        </li>
                    @endif
                @endauth

                <li class="nav-item">
                    <a class="nav-link fw-semibold text-danger" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- البحث -->
        <form method="GET" action="{{ route('post.index') }}" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="username" placeholder=" المستخدم..."
                value="{{ request('username') }}">
            <button class="btn btn-outline-primary" type="submit">🔍</button>
        </form>
    </div>
</nav>

<!-- أقسام الموقع -->
@php
    $activeCategory = request('postCategory');
@endphp

<div class="bg-light py-2 border-bottom shadow-sm">
    <div class="container d-flex justify-content-center gap-3 flex-wrap">
        @foreach (['ثقافي', 'تعليمي', 'تاريخ', 'تكنولوجيا'] as $category)
            <a href="{{ route('post.index', ['postCategory' => $category]) }}"
                class="btn {{ $activeCategory === $category ? 'btn-primary' : 'btn-outline-secondary' }} px-4 rounded-pill">
                {{ $category }}
            </a>
        @endforeach
    </div>
</div>
