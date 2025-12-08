@extends('layouts.admin')

@section('content')
<h1>Chỉnh sửa Booking #{{ $booking->id }}</h1>

<form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Chọn phòng --}}
    <div>
        <label>Chọn phòng</label>
        <select name="room_id">
            @foreach($rooms as $room)
                <option value="{{ $room->id }}" {{ old('room_id', $booking->room_id) == $room->id ? 'selected' : '' }}>
                    {{ $room->title }} — {{ number_format($room->price_per_night) }}₫/đêm
                </option>
            @endforeach
        </select>
        @error('room_id')
        <p>{{ $message }}</p>
        @enderror
    </div>

    {{-- Tên khách --}}
    <div>
        <label>Tên khách hàng</label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}">
        @error('customer_name')
        <p>{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label>Email</label>
        <input type="email" name="customer_email" value="{{ old('customer_email', $booking->customer_email) }}">
        @error('customer_email')
        <p>{{ $message }}</p>
        @enderror
    </div>

    {{-- Ngày nhận phòng --}}
    <div>
        <label>Ngày nhận phòng</label>
        <input type="date" name="check_in" value="{{ old('check_in', $booking->check_in) }}">
        @error('check_in')
        <p>{{ $message }}</p>
        @enderror
    </div>

    {{-- Ngày trả phòng --}}
    <div>
        <label>Ngày trả phòng</label>
        <input type="date" name="check_out" value="{{ old('check_out', $booking->check_out) }}">
        @error('check_out')
        <p>{{ $message }}</p>
        @enderror
    </div>

    {{-- Upload hình mới --}}
    <div>
        <label>Hình xác nhận mới (nếu đổi)</label>
        <input type="file" name="image" accept="image/*">
        @error('image')
        <p>{{ $message }}</p>
        @enderror

        {{-- Hiển thị hình cũ --}}
        @if($booking->image)
            <p>Hình hiện tại</p>
            <img src="{{ asset('storage/' . $booking->image) }}" width="150">
        @endif
    </div>

    <div>
        <button type="submit">Cập nhật</button>
        <a href="{{ route('admin.bookings.index') }}">Hủy</a>
    </div>

</form>
@endsection
