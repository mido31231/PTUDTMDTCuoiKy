@extends('layouts.admin')

@section('content')
<h1 class="text-xl font-semibold mb-6 dark:text-gray-100">Chỉnh sửa Booking #{{ $booking->id }}</h1>

<form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    {{-- Chọn phòng --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Chọn phòng
        </label>
        <select
            name="room_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
        >
            @foreach($rooms as $room)
                <option value="{{ $room->id }}" {{ old('room_id', $booking->room_id) == $room->id ? 'selected' : '' }}>
                    {{ $room->title }} — {{ number_format($room->price_per_night) }}₫/đêm
                </option>
            @endforeach
        </select>
        @error('room_id')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tên khách --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Tên khách hàng
        </label>
        <input
            type="text"
            name="customer_name"
            value="{{ old('customer_name', $booking->customer_name) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
        >
        @error('customer_name')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Email
        </label>
        <input
            type="email"
            name="customer_email"
            value="{{ old('customer_email', $booking->customer_email) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
        >
        @error('customer_email')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Ngày nhận phòng --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Ngày nhận phòng
        </label>
        <input
            type="date"
            name="check_in"
            value="{{ old('check_in', $booking->check_in) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
        >
        @error('check_in')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Ngày trả phòng --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Ngày trả phòng
        </label>
        <input
            type="date"
            name="check_out"
            value="{{ old('check_out', $booking->check_out) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
        >
        @error('check_out')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Upload hình mới --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Hình xác nhận mới (nếu đổi)
        </label>
        <input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm dark:text-gray-100">

        @error('image')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror

        {{-- Hiển thị hình cũ --}}
        @if($booking->image)
            <p class="mt-3 text-sm dark:text-gray-300">Hình hiện tại:</p>
            <img src="{{ asset('storage/' . $booking->image) }}" class="w-40 rounded-md mt-2 border dark:border-gray-700">
        @endif
    </div>

    <div class="flex items-center space-x-3">
        <button type="submit"
                class="px-4 py-2 rounded-md bg-indigo-600 text-sm font-semibold text-white hover:bg-indigo-500">
            Cập nhật
        </button>

        <a href="{{ route('admin.bookings.index') }}"
           class="px-4 py-2 rounded-md border border-gray-300 text-sm dark:border-gray-700 dark:text-gray-300">
            Hủy
        </a>
    </div>

</form>
@endsection
