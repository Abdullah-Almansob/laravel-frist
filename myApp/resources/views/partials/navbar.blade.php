<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">

        <!-- شعار الموقع -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" width="35" height="35">
            <span class="fw-bold text-primary" style="font-family: 'Cairo', sans-serif; font-size: 20px;">مدونتي</span>
        </a>

        <!-- زر القائمة في الشاشات الصغيرة -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- الروابط -->
        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0" style="font-family: 'Cairo', sans-serif;">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('post.index') }}">المنشورات</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('register') }}">مستخدم جديد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        تسجيل الخروج
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


                @auth
                    @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">👥 إدارة المستخدمين</a>
                        </li>
                    @endif
                @endauth


            </ul>

            <!-- أيقونة البحث -->
            <form method="GET" action="{{ route('post.index') }}" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="username" placeholder=" المستخدم..."
                    value="{{ request('username') }}">
                <button class="btn btn-outline-primary" type="submit">🔍</button>
            </form>

        </div>
    </div>
</nav>
