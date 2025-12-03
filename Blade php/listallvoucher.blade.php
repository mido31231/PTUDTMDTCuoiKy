@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/read.css') }}">

<div class="read-container">
    <h1 class="read-title">Danh sách voucher</h1>

    <a href="{{ route('host.vouchers.create') }}" class="btn-edit">Thêm voucher mới</a>

    <table class="room-table">
        <thead>
            <tr>
                <th>Tên voucher</th>
                <th>Mô tả</th>
                <th>Giá trị giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
            <tr>
                <td>{{ $voucher->name }}</td>
                <td>{{ $voucher->description }}</td>
                <td>{{ number_format($voucher->discount_value,0,',','.') }} VNĐ</td>
                <td>{{ $voucher->start_date }}</td>
                <td>{{ $voucher->end_date }}</td>
                <td>{{ $voucher->is_active ? 'Đang hoạt động' : 'Tạm ngừng' }}</td>
                <td>
                    <a href="{{ route('host.vouchers.show', $voucher->id) }}" class="btn-back">Xem</a>
                    <a href="{{ route('host.vouchers.edit', $voucher->id) }}" class="btn-edit">Sửa</a>
                    <form action="{{ route('host.vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline"
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa voucher này?');">
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
