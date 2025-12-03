@extends('layouts.host')

@section('content')
<link rel="stylesheet" href="{{ asset('css/read.css') }}">

<div class="read-container">
    <h1 class="read-title">Xóa phòng</h1>

    <div class="delete-box">
        Bạn có chắc chắn muốn xóa phòng <strong>{{ $room->title }}</strong>?
        Hành động này không thể khôi phục.
    </div>

    <div class="read-actions">
        <a href="{{ route('host.rooms.index') }}" class="btn-back">Hủy</a>

        <form action="{{ route('host.rooms.destroy', $room->id) }}" method="POST"
              onsubmit="return confirm('Bạn thật sự muốn xóa phòng này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa phòng</button>
        </form>
    </div>
</div>
@endsection
