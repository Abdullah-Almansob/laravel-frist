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

                <div class="card shadow-sm rounded-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"> إنشاء بوست جديد</h4>
                    </div>

                    <div class="card-body">

                        {{-- عرض اسم المستخدم --}}
                        @auth
                            <div class="mb-3">
                                <label class="form-label fw-bold text-center d-block">اسم المستخدم</label>
                                <div class="form-control-plaintext text-center">{{ Auth::user()->name }}</div>
                            </div>
                        @endauth

                        {{-- نموذج البوست --}}
                        <form method="POST" action="{{ route('post.store') }}">
                            @csrf

                            {{-- العنوان --}}
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold text-center d-block">عنوان البوست</label>
                                <input type="text" class="form-control form-control-lg text-center"
                                    value="{{ old('title') }}" name="title" id="title" required>
                            </div>

                            {{-- الوصف --}}
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold text-center d-block">وصف البوست</label>
                                <textarea class="form-control" name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
                            </div>

                            {{-- نوع البوست --}}
                            <div class="mb-4">
                                <select class="form-select form-select-lg text-center" name="postCategory" required>
                                    <option value="" disabled selected> اختر نوع البوست </option>
                                    <option value="ديني">ديني</option>
                                    <option value="مشاعر">مشاعر</option>
                                    <option value="تكنولوجيا">تكنولوجيا</option>
                                    <option value="تاريخ">تاريخ</option>
                                    <option value="تعليمي">تعليمي</option>
                                    <option value="ثقافي">ثقافي</option>
                                </select>
                            </div>

                            {{-- user_id مخفي --}}
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            {{-- زر الإرسال --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-5 py-2 fs-5 rounded-pill shadow-sm">
                                    نشر البوست
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
