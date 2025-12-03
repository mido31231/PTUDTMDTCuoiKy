@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/css.css') }}">

<div class="read-container">
    <lable class="read-title">Thông tin Booking</lable>

    @if($booking->room && $booking->room->image)
    <div class="read-section">
        <label>Hình ảnh phòng:</label>
        <img src="{{ asset('storage/' . $booking->room->image) }}" alt="Hình phòng" class="read-image">
    </div>
    @endif    

    <div class="read-section">
        <label>Tên khách:</label>
        <p>{{ $booking->customer_name }}</p>
    </div>

    <div class="read-section">
        <label>Phòng:</label>
        <p>{{ $booking->room->title ?? 'Không có' }}</p>
    </div>

    <div class="read-grid">
        <div class="read-section">
            <label>Ngày nhận phòng:</label>
            <p>{{ $booking->check_in_date }}</p>
        </div>

        <div class="read-section">
            <label>Ngày trả phòng:</label>
            <p>{{ $booking->check_out_date }}</p>
        </div>

        <div class="read-section">
            <label>Tổng tiền:</label>
            <p>{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</p>
        </div>
    </div>

    <div class="read-section">
        <label>Trạng thái:</label>
        <p>
            @if($booking->status === 'confirmed')
                Đã xác nhận
            @elseif($booking->status === 'pending')
                Chờ xác nhận
            @else
                Hủy
            @endif
        </p>
    </div>

    <div class="read-actions">
        <a href="{{ route('host.bookings.index') }}" class="btn-back">Quay lại</a>
        <a href="{{ route('host.bookings.edit', $booking->id) }}" class="btn-edit">Chỉnh sửa</a>
        <form action="{{ route('host.bookings.destroy', $booking->id) }}" method="POST"
              onsubmit="return confirm('Bạn chắc chắn muốn xoá booking này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa</button>
        </form>
    </div>
</div>
@endsection
