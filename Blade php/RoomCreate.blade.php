@extends('layouts.admin')

@section('content')

    <h1>Tạo Phòng Mới</h1>

    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- TIÊU ĐỀ --}}
        <div>
            <label>Tiêu đề phòng</label>
            <input type="text" name="title" placeholder="Ví dụ: Phòng Deluxe Hướng Biển">
        </div>

        {{-- MÔ TẢ --}}
        <div>
            <label>Mô tả</label>
            <textarea name="description" rows="4" placeholder="Mô tả chi tiết về phòng..."></textarea>
        </div>

        {{-- GRID: SỐ KHÁCH / GIÁ / ĐỊA ĐIỂM --}}
        <div>
            <div>
                <label>Số khách tối đa</label>
                <input type="number" name="capacity" min="1" value="1">
            </div>

            <div>
                <label>Giá / đêm (VNĐ)</label>
                <input type="number" step="0.01" name="price_per_night">
            </div>

            <div>
                <label>Địa điểm</label>
                <input type="text" name="location" placeholder="Hà Nội, Đà Nẵng...">
            </div>
        </div>

        {{-- UPLOAD NHIỀU ẢNH --}}
        <div>
            <label>Ảnh phòng (nhiều ảnh)</label>
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
        <div>
            <input id="is_active" type="checkbox" name="is_active" value="1" checked>
            <label for="is_active">Đang hoạt động</label>
        </div>

        {{-- BUTTON --}}
        <div>
            <button type="submit">Tạo phòng</button>
            <a href="{{ route('admin.rooms.index') }}">Hủy</a>
        </div>
    </form>
</div>
@endsection
