@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tạo Phòng Mới</h1>

    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf

        {{-- TIÊU ĐỀ --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700">Tiêu đề phòng</label>
            <input type="text" name="title"
                class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                placeholder="Ví dụ: Phòng Deluxe Hướng Biển">
        </div>

        {{-- MÔ TẢ --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700">Mô tả</label>
            <textarea name="description" rows="4"
                class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                placeholder="Mô tả chi tiết về phòng..."></textarea>
        </div>

        {{-- GRID: SỐ KHÁCH / GIÁ / ĐỊA ĐIỂM --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Số khách tối đa</label>
                <input type="number" name="capacity" min="1"
                    class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500" value="1">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Giá / đêm (VNĐ)</label>
                <input type="number" step="0.01" name="price_per_night"
                    class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Địa điểm</label>
                <input type="text" name="location"
                    class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                    placeholder="Hà Nội, Đà Nẵng...">
            </div>
        </div>

        {{-- UPLOAD NHIỀU ẢNH --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700">Ảnh phòng (nhiều ảnh)</label>

            <input type="file" name="images[]" multiple
                   id="imageInput"
                   class="mt-2 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer">

            <div id="preview" class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4"></div>

            <script>
                const input = document.getElementById('imageInput');
                const preview = document.getElementById('preview');

                input.addEventListener('change', () => {
                    preview.innerHTML = "";
                    [...input.files].forEach(file => {
                        const reader = new FileReader();
                        reader.onload = e => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = "w-full h-32 object-cover rounded-md border";
                            preview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            </script>
        </div>

        {{-- TRẠNG THÁI --}}
        <div class="flex items-center">
            <input id="is_active" type="checkbox" name="is_active" value="1"
                class="h-4 w-4 text-indigo-600 border-gray-300 rounded" checked>
            <label for="is_active" class="ml-2 text-sm text-gray-700">Đang hoạt động</label>
        </div>

        {{-- BUTTON --}}
        <div class="flex items-center space-x-3 pt-4">
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md hover:bg-indigo-500">
                Tạo phòng
            </button>

            <a href="{{ route('admin.rooms.index') }}"
                class="px-5 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                Hủy
            </a>
        </div>
    </form>
</div>
@endsection
