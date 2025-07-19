<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدونتي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand d-flex align-items-center gap-2 me-auto" href="{{ url('/') }}">
                <img src="{{ asset('storage/images/logo.png') }}" width="35" height="35">
                <span class="fw-bold text-warning">مدونتي</span>
            </a>

            <div class="d-none d-lg-block">
                <ul class="navbar-nav d-flex flex-row gap-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('post.index') }}">المنشورات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">مستخدم جديد</a>
                    </li>

                </ul>
            </div>

            @auth
                <div class="ms-auto">
                    <a class="btn btn-outline-danger btn-sm" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endauth

        </div>
    </nav>

    <!-- ✅ محتوى الصفحة -->
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- ✅ السكربتات -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @vite('resources/js/main.js')

</body>

</html>
