@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/css.css') }}">

<div class="read-container">
    <label class="read-title">Thông tin phòng</label>

    @if($room->image)
    <div class="read-section">
        <label>Hình ảnh:</label>
        <img src="{{ asset('storage/' . $room->image) }}" alt="Hình phòng" class="read-image">
    </div>
    @endif

    <div class="read-section">
        <label>Tiêu đề phòng:</label>
        <p>{{ $room->title }}</p>
    </div>

    <div class="read-section">
        <label>Mô tả:</label>
        <p>{{ $room->description }}</p>
    </div>

    <div class="read-grid">
        <div class="read-section">
            <label>Số khách tối đa:</label>
            <p>{{ $room->capacity }}</p>
        </div>

        <div class="read-section">
            <label>Giá / đêm:</label>
            <p>{{ number_format($room->price_per_night, 0, ',', '.') }} VNĐ</p>
        </div>

        <div class="read-section">
            <label>Địa điểm:</label>
            <p>{{ $room->location }}</p>
        </div>
    </div>

    <div class="read-section">
        <label>Trạng thái:</label>
        <p>{{ $room->is_active ? 'Đang hoạt động' : 'Tạm ngừng' }}</p>
    </div>

    <div class="read-actions">
        <a href="{{ route('host.rooms.index') }}" class="btn-back">Quay lại</a>
        <a href="{{ route('host.rooms.edit', $room->id) }}" class="btn-edit">Chỉnh sửa</a>
        <form action="{{ route('host.rooms.destroy', $room->id) }}" method="POST"
              onsubmit="return confirm('Bạn chắc chắn muốn xoá phòng này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa</button>
        </form>
    </div>
</div>
@endsection