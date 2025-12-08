@extends('layouts.admin')

@section('content')
<div>
    <h1>Cập nhật Phòng</h1>

    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- TIÊU ĐỀ --}}
        <div>
            <label>Tiêu đề phòng</label>
            <input type="text" name="title" value="{{ old('title', $room->title) }}">
        </div>

        {{-- MÔ TẢ --}}
        <div>
            <label>Mô tả</label>
            <textarea name="description" rows="4">{{ old('description', $room->description) }}</textarea>
        </div>

        {{-- GRID: SỐ KHÁCH / GIÁ / ĐỊA ĐIỂM --}}
        <div>
            <div>
                <label>Số khách tối đa</label>
                <input type="number" name="capacity" min="1" value="{{ old('capacity', $room->capacity) }}">
            </div>

            <div>
                <label>Giá / đêm (VNĐ)</label>
                <input type="number" step="0.01" name="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}">
            </div>

            <div>
                <label>Địa điểm</label>
                <input type="text" name="location" value="{{ old('location', $room->location) }}">
            </div>
        </div>

        {{-- ẢNH HIỆN CÓ --}}
        <div>
            <label>Ảnh hiện có</label>
            <div>
                @foreach($room->images as $image)
                    <div>
                        <img src="{{ asset('storage/'.$image->path) }}" width="160" height="120>
                        <label>
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                            Xóa
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- UPLOAD NHIỀU ẢNH MỚI --}}
        <div>
            <label>Thêm ảnh mới</label>
            <input type="file" name="images[]" multiple id="imageInput">
            <div id="preview"></div>

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
                            img.width = 120;
                            img.height = 100;
                            preview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            </script>
        </div>

        {{-- TRẠNG THÁI --}}
        <div class="flex items-center">
            <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
            <label for="is_active">Đang hoạt động</label>
        </div>

        {{-- BUTTON --}}
        <div>
            <button type="submit">Cập nhật phòng</button>
            <a href="{{ route('admin.rooms.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection
