@extends('layouts.admin')

@section('content')
<div>

    <h2>Tạo Booking mới</h2>

    <form action="{{ route('admin.bookings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- CHỌN KHÁCH HÀNG --}}
        <div>
            <label>Khách hàng</label>
            <select name="customer_id">
                <option value="">Chọn khách hàng</option>

                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} — {{ $customer->email }}
                    </option>
                @endforeach
            </select>

            @error('customer_id')
            <p>{{ $message }}</p>
            @enderror
        </div>

        {{-- CHỌN PHÒNG --}}
        <div>
            <label>Phòng</label>
            <select name="room_id">
                <option value="">Chọn phòng</option>

                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->title }} — {{ number_format($room->price_per_night) }}đ/đêm
                    </option>
                @endforeach
            </select>

            @error('room_id')
            <p>{{ $message }}</p>
            @enderror
        </div>

        {{-- NGÀY CHECK-IN & CHECK-OUT --}}
        <div>
            <div>
                <label>Check-in</label>
                <input type="date" name="check_in" value="{{ old('check_in') }}">

                @error('check_in')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label>Check-out</label>
                <input type="date" name="check_out" value="{{ old('check_out') }}">
                
                @error('check_out')
                <p>{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- SỐ KHÁCH --}}
        <div>
            <label>Số khách</label>
            <input type="number" name="guests" min="1" value="{{ old('guests', 1) }}">

            @error('guests')
            <p>{{ $message }}</p>
            @enderror
        </div>

        {{-- GHI CHÚ --}}
        <div>
            <label>Ghi chú (nếu có)</label>
            <textarea name="note" rows="3">{{ old('note') }}</textarea>

            @error('note')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- UPLOAD HÌNH --}}
        <div>
            <label>Hình ảnh (tối đa 5 hình)</label>

            <input type="file" name="images[]" multiple accept="image/*">

            @error('images')
            <p>{{ $message }}</p>
            @enderror

            @error('images.*')
            <p>{{ $message }}</p>
            @enderror
        </div>

        {{-- TRẠNG THÁI --}}
        <div>
            <label>Trạng thái</label>
            <select name="status">
                <option value="pending"  {{ old('status') === 'pending' ? 'selected' : '' }}>Đang chờ</option>
                <option value="active"   {{ old('status') === 'active' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="cancelled"{{ old('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        {{-- NÚT SUBMIT --}}
        <div>
            <button type="submit">Tạo Booking</button>
            <a href="{{ route('admin.bookings.index') }}"Hủy</a>
        </div>

    </form>
</div>
@endsection
