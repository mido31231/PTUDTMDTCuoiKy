@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/read.css') }}">

<div class="read-container">
    <h1 class="read-title">Danh sách booking</h1>

    <table class="room-table">
        <thead>
            <tr>
                <th>Hình phòng</th>
                <th>Tên khách</th>
                <th>Phòng</th>
                <th>Ngày nhận</th>
                <th>Ngày trả</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>
                    @if($booking->room && $booking->room->image)
                        <img src="{{ asset('storage/' . $booking->room->image) }}" alt="Hình phòng" style="width:80px; border-radius:4px;">
                    @endif
                </td>
                <td>{{ $booking->customer_name }}</td>
                <td>{{ $booking->room->title ?? 'Không có' }}</td>
                <td>{{ $booking->check_in_date }}</td>
                <td>{{ $booking->check_out_date }}</td>
                <td>{{ number_format($booking->total_price,0,',','.') }} VNĐ</td>
                <td>
                    @if($booking->status === 'confirmed')
                        Đã xác nhận
                    @elseif($booking->status === 'pending')
                        Chờ xác nhận
                    @else
                        Hủy
                    @endif
                </td>
                <td>
                    <a href="{{ route('host.bookings.show', $booking->id) }}" class="btn-back">Xem</a>
                    <a href="{{ route('host.bookings.edit', $booking->id) }}" class="btn-edit">Sửa</a>
                    <form action="{{ route('host.bookings.destroy', $booking->id) }}" method="POST" style="display:inline"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa booking này?');">
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