@extends('layouts.admin')

@section('content')
<div>
    <h1>Chỉnh sửa voucher: {{ $voucher->code }}</h1>

    <form method="POST" action="{{ route('admin.vouchers.update', $voucher->id) }}">
        @csrf
        @method('PUT')

        <div>

            {{-- Mã voucher --}}
            <div>
                <label>Mã voucher</label>
                <input type="text" name="code" value="{{ old('code', $voucher->code) }}">
                @error('code')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Mô tả --}}
            <div>
                <label>Mô tả</label>
                <textarea name="description">{{ old('description', $voucher->description) }}</textarea>
                @error('description')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Giảm giá --}}
            <div>
                <label>Giảm giá (%)</label>
                <input type="number" name="discount_percentage" min="1" max="100" value="{{ old('discount_percentage', $voucher->discount_percentage) }}">
                @error('discount_percentage')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Số lượng --}}
            <div>
                <label>Số lượng</label>
                <input type="number" name="quantity" min="1" value="{{ old('quantity', $voucher->quantity) }}">
                @error('quantity')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Giá trị tối thiểu --}}
            <div>
                <label>Giá trị tối thiểu (VNĐ)</label>
                <input type="number" step="1000" name="min_order_value" value="{{ old('min_order_value', $voucher->min_order_value) }}">
                @error('min_order_value')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Ngày bắt đầu --}}
            <div>
                <label>Ngày bắt đầu</label>
                <input type="date" name="start_date" value="{{ old('start_date', $voucher->start_date) }}">
                @error('start_date')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Ngày kết thúc --}}
            <div>
                <label>Ngày kết thúc</label>
                <input type="date" name="end_date" value="{{ old('end_date', $voucher->end_date) }}">
                @error('end_date')
                <p>{{ $message }}</p>
                @enderror
            </div>

            {{-- Trạng thái --}}
            <div>
                <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $voucher->is_active) ? 'checked' : '' }}>
                <label for="is_active">Đang hoạt động</label>
            </div>

            {{-- Buttons --}}
            <div>
                <button type="submit">Cập nhật</button>
                <a href="{{ route('admin.vouchers.index') }}">Hủy</a>
            </div>

        </div>
    </form>
</div>
@endsection
