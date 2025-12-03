@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/css.css') }}">

<div class="read-container">
    <h1 class="read-title">Danh sách phòng</h1>

    <a href="{{ route('host.rooms.create') }}" class="btn-edit">Thêm phòng mới</a>

    <table class="room-table">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Giá / đêm</th>
                <th>Số khách</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Hình phòng" style="width:80px; border-radius:4px;">
                    @endif
                </td>
                <td>{{ $room->title }}</td>
                <td>{{ number_format($room->price_per_night, 0, ',', '.') }} VNĐ</td>
                <td>{{ $room->capacity }}</td>
                <td>{{ $room->is_active ? 'Đang hoạt động' : 'Tạm ngừng' }}</td>
                <td>
                    <a href="{{ route('host.rooms.show', $room->id) }}" class="btn-back">Xem</a>
                    <a href="{{ route('host.rooms.edit', $room->id) }}" class="btn-edit">Sửa</a>
                    <form action="{{ route('host.rooms.destroy', $room->id) }}" method="POST" style="display:inline"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa phòng này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection