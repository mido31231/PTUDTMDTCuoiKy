@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Cập nhật Phòng</h1>

    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        {{-- TIÊU ĐỀ --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700">Tiêu đề phòng</label>
            <input type="text" name="title"
                class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                value="{{ old('title', $room->title) }}">
        </div>

        {{-- MÔ TẢ --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700">Mô tả</label>
            <textarea name="description" rows="4"
                class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500">{{ old('description', $room->description) }}</textarea>
        </div>

        {{-- GRID: SỐ KHÁCH / GIÁ / ĐỊA ĐIỂM --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Số khách tối đa</label>
                <input type="number" name="capacity" min="1"
                    class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                    value="{{ old('capacity', $room->capacity) }}">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Giá / đêm (VNĐ)</label>
                <input type="number" step="0.01" name="price_per_night"
                    class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                    value="{{ old('price_per_night', $room->price_per_night) }}">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Địa điểm</label>
                <input type="text" name="location"
                    class="mt-1 w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500"
                    value="{{ old('location', $room->location) }}">
            </div>
        </div>

        {{-- ẢNH HIỆN CÓ --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Ảnh hiện có</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($room->images as $image)
                    <div class="relative">
                        <img src="{{ asset('storage/'.$image->path) }}" class="w-full h-32 object-cover rounded-md border">
                        <label class="absolute top-1 right-1 bg-red-600 text-white text-xs px-1 rounded cursor-pointer">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                            Xóa
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- UPLOAD NHIỀU ẢNH MỚI --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700">Thêm ảnh mới</label>
            <input type="file" name="images[]" multiple id="imageInput"
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
                class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="ml-2 text-sm text-gray-700">Đang hoạt động</label>
        </div>

        {{-- BUTTON --}}
        <div class="flex items-center space-x-3 pt-4">
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md hover:bg-indigo-500">
                Cập nhật phòng
            </button>

            <a href="{{ route('admin.rooms.index') }}"
                class="px-5 py-2 border rounded-md text-sm text-gray-600 hover:bg-gray-100">
                Hủy
            </a>
        </div>
    </form>
</div>
@endsection
