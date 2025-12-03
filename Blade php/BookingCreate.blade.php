@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-gray-100">
        Tạo Booking mới
    </h2>

    <form action="{{ route('admin.bookings.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        {{-- CHỌN KHÁCH HÀNG --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Khách hàng
            </label>
            <select name="customer_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm">
                <option value="">-- Chọn khách hàng --</option>

                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} — {{ $customer->email }}
                    </option>
                @endforeach
            </select>

            @error('customer_id')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- CHỌN PHÒNG --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Phòng
            </label>
            <select name="room_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm">
                <option value="">-- Chọn phòng --</option>

                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->title }} — {{ number_format($room->price_per_night) }}đ/đêm
                    </option>
                @endforeach
            </select>

            @error('room_id')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- NGÀY CHECK-IN & CHECK-OUT --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Check-in
                </label>
                <input type="date"
                       name="check_in"
                       value="{{ old('check_in') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                              focus:border-indigo-500 focus:ring-indigo-500
                              dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm">

                @error('check_in')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Check-out
                </label>
                <input type="date"
                       name="check_out"
                       value="{{ old('check_out') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                              focus:border-indigo-500 focus:ring-indigo-500
                              dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm">

                @error('check_out')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- SỐ KHÁCH --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Số khách
            </label>
            <input type="number"
                   name="guests"
                   min="1"
                   value="{{ old('guests', 1) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                          focus:border-indigo-500 focus:ring-indigo-500
                          dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm">

            @error('guests')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- GHI CHÚ --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Ghi chú (nếu có)
            </label>
            <textarea name="note" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                       focus:border-indigo-500 focus:ring-indigo-500
                       dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
            >{{ old('note') }}</textarea>

            @error('note')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- UPLOAD HÌNH --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Hình ảnh (tối đa 5 hình)
            </label>

            <input type="file"
                   name="images[]"
                   multiple
                   accept="image/*"
                   class="mt-2 block w-full text-sm text-gray-700 
                          dark:text-gray-100 file:mr-4 file:py-2 file:px-4 
                          file:rounded-md file:border-0 
                          file:bg-indigo-600 file:text-white 
                          hover:file:bg-indigo-500">

            @error('images')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror

            @error('images.*')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- TRẠNG THÁI --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Trạng thái
            </label>
            <select name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm">
                <option value="pending"  {{ old('status') === 'pending' ? 'selected' : '' }}>Đang chờ</option>
                <option value="active"   {{ old('status') === 'active' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="cancelled"{{ old('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        {{-- NÚT SUBMIT --}}
        <div class="flex items-center space-x-3">
            <button type="submit"
                class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 
                       text-sm font-semibold text-white shadow-sm 
                       hover:bg-indigo-500 focus:outline-none 
                       focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Tạo Booking
            </button>

            <a href="{{ route('admin.bookings.index') }}"
               class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 
                      text-sm font-medium text-gray-700 hover:bg-gray-50 
                      dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
                Hủy
            </a>
        </div>

    </form>
</div>
@endsection
