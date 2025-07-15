 @include('partials.navbar')
 @section('title', 'login')
 @section('content')
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
     <div class="bg-light">

         <div class="container d-flex justify-content-center align-items-center vh-100">
             <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
                 <h2 class="text-center mb-4">تسجيل الدخول</h2>

                 @if ($errors->any())
                     <div class="alert alert-danger">
                         <ul class="mb-0">
                             @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                 @endif

                 <form method="POST" action="{{ route('login.custom') }}">
                     @csrf

                     <div class="mb-3">
                         <label for="email" class="form-label">البريد الإلكتروني:</label>
                         <input type="email" class="form-control" id="email" name="email"
                             value="{{ old('email') }}" required autofocus />
                     </div>

                     <div class="mb-4">
                         <label for="password" class="form-label">كلمة المرور:</label>
                         <input type="password" class="form-control" id="password" name="password" required />
                     </div>

                     <button type="submit" class="btn btn-primary w-100">دخول</button>
                 </form>
             </div>
         </div>

     </div>
