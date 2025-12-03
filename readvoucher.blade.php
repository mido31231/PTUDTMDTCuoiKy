@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/css.css') }}">

<div class="read-container">
    <label class="read-title">Thông tin Voucher</label>

    <div class="read-section">
        <label>Tên voucher:</label>
        <p>{{ $voucher->name }}</p>
    </div>

    <div class="read-section">
        <label>Mô tả:</label>
        <p>{{ $voucher->description }}</p>
    </div>

    <div class="read-grid">
        <div class="read-section">
            <label>Giá trị giảm:</label>
            <p>{{ number_format($voucher->discount_value, 0, ',', '.') }} VNĐ</p>
        </div>

        <div class="read-section">
            <label>Ngày bắt đầu:</label>
            <p>{{ $voucher->start_date }}</p>
        </div>

        <div class="read-section">
            <label>Ngày kết thúc:</label>
            <p>{{ $voucher->end_date }}</p>
        </div>
    </div>

    <div class="read-section">
        <label>Trạng thái:</label>
        <p>{{ $voucher->is_active ? 'Đang hoạt động' : 'Hết hạn' }}</p>
    </div>

    <div class="read-actions">
        <a href="{{ route('host.vouchers.index') }}" class="btn-back">Quay lại</a>
        <a href="{{ route('host.vouchers.edit', $voucher->id) }}" class="btn-edit">Chỉnh sửa</a>
        <form action="{{ route('host.vouchers.destroy', $voucher->id) }}" method="POST"
              onsubmit="return confirm('Bạn chắc chắn muốn xoá voucher này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa</button>
        </form>
    </div>
</div>
@endsection
