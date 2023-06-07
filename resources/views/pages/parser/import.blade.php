@extends('layouts.base')

@section('body')
    @if ($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif

    @if (!isset($access_closed))
        <form method="POST" action="{{ route('parser.import') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button>Отправить</button>
        </form>
    @endif

    {{ isset($message) ? $message : '' }}
@endsection
