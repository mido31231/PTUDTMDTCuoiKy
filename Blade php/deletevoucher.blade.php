@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/read.css') }}">

<div class="read-container">
    <h1 class="read-title">Xóa voucher</h1>

    <div class="delete-box">
        Bạn có chắc chắn muốn xóa voucher <strong>{{ $voucher->name }}</strong>?
        Hành động này không thể khôi phục.
    </div>

    <div class="read-actions">
        <a href="{{ route('host.vouchers.index') }}" class="btn-back">Hủy</a>

        <form action="{{ route('host.vouchers.destroy', $voucher->id) }}" method="POST"
              onsubmit="return confirm('Bạn thật sự muốn xóa voucher này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa voucher</button>
        </form>
    </div>
</div>
@endsection