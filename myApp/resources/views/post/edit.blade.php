@extends('layouts.main')
@section('title', 'post-edit')
@section('content')
    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" class="container mt-5">
        @csrf
        @method('PUT')

        <div class="card shadow-lg p-4 rounded-4 border-0">
            <h2 class="mb-4 text-center text-primary">تعديل المنشور</h2>

            {{-- عنوان --}}
            <div class="mb-3">
                <label class="form-label fw-bold text-center d-block">عنوان المنشور</label>
                <input name="title" value="{{ old('title', $post->title) }}"
                    class="form-control form-control-lg text-center" placeholder="اكتب عنوانًا جذابًا" required>
            </div>

            {{-- وصف --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-center d-block">وصف المنشور</label>
                <textarea name="description" class="form-control" rows="4" placeholder="أدخل وصفًا واضحًا ومفصلًا" required>{{ old('description', $post->description) }}</textarea>
            </div>

            {{-- صورة جديدة (اختياري) --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-center d-block">تغيير الصورة (اختياري)</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- اسم المستخدم --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-center d-block">اختر اسم المستخدم</label>
                <select name="user_id" class="form-select form-select-lg">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id', $post->user_id) == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- زر التحديث --}}
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5 py-2 fs-5 rounded-pill shadow-sm">
                    تحديث المنشور
                </button>
            </div>
        </div>
    </form>



@endsection
