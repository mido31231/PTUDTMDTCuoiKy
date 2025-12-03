@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
        Chỉnh sửa voucher: {{ $voucher->code }}
    </h1>

    <form method="POST" action="{{ route('admin.vouchers.update', $voucher->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            {{-- Mã voucher --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Mã voucher
                </label>
                <input
                    type="text"
                    name="code"
                    value="{{ old('code', $voucher->code) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                >
                @error('code')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mô tả --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Mô tả
                </label>
                <textarea
                    name="description"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                >{{ old('description', $voucher->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Grid 3 cột --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                {{-- Giảm giá --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Giảm giá (%)
                    </label>
                    <input
                        type="number"
                        name="discount_percentage"
                        min="1"
                        max="100"
                        value="{{ old('discount_percentage', $voucher->discount_percentage) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500
                               dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                    >
                    @error('discount_percentage')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Số lượng --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Số lượng
                    </label>
                    <input
                        type="number"
                        name="quantity"
                        min="1"
                        value="{{ old('quantity', $voucher->quantity) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500
                               dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                    >
                    @error('quantity')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Giá trị tối thiểu --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Giá trị tối thiểu (VNĐ)
                    </label>
                    <input
                        type="number"
                        step="1000"
                        name="min_order_value"
                        value="{{ old('min_order_value', $voucher->min_order_value) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               focus:border-indigo-500 focus:ring-indigo-500
                               dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                    >
                    @error('min_order_value')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Ngày bắt đầu --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Ngày bắt đầu
                </label>
                <input
                    type="date"
                    name="start_date"
                    value="{{ old('start_date', $voucher->start_date) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                >
                @error('start_date')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ngày kết thúc --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Ngày kết thúc
                </label>
                <input
                    type="date"
                    name="end_date"
                    value="{{ old('end_date', $voucher->end_date) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           focus:border-indigo-500 focus:ring-indigo-500
                           dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 text-sm"
                >
                @error('end_date')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Trạng thái --}}
            <div class="flex items-center">
                <input
                    id="is_active"
                    type="checkbox"
                    name="is_active"
                    value="1"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ old('is_active', $voucher->is_active) ? 'checked' : '' }}
                >
                <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                    Đang hoạt động
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center space-x-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm
                           font-semibold text-white shadow-sm hover:bg-indigo-500
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Cập nhật
                </button>

                <a href="{{ route('admin.vouchers.index') }}"
                   class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm
                          font-medium text-gray-700 hover:bg-gray-50
                          dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
                    Hủy
                </a>
            </div>

        </div>
    </form>
</div>
@endsection
