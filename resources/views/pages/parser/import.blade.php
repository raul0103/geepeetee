@extends('layouts.base')
@section('pagetitle', 'Импорт запросов')
@section('body')
    @if (!isset($access_closed))
        <form class="form" method="POST" action="{{ route('parser.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="file">
                <div class="form-error">
                    @error('file')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <button class="btn btn-primary">Отправить</button>
        </form>
    @endif

    <div class="mt-1">{{ isset($message) ? $message : '' }}</div>
@endsection
