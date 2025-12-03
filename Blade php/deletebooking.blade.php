@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/read.css') }}">

<div class="read-container">
    <h1 class="read-title">Xóa booking</h1>

    <div class="delete-box">
        Bạn có chắc chắn muốn xóa booking của <strong>{{ $booking->customer_name }}</strong>?
        Hành động này không thể khôi phục.
    </div>

    <div class="read-actions">
        <a href="{{ route('host.bookings.index') }}" class="btn-back">Hủy</a>

        <form action="{{ route('host.bookings.destroy', $booking->id) }}" method="POST"
              onsubmit="return confirm('Bạn thật sự muốn xóa booking này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa booking</button>
        </form>
    </div>
</div>
@endsection