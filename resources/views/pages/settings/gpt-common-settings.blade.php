@extends('layouts.base')
@section('pagetitle', 'Общие')
@section('body')
    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="section-group">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Параметры запроса к API GPT
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="POST" action="{{ route('settings.common') }}">
                    @csrf
                    @method('PUT')

                    @foreach ($default_settings as $default_setting)
                        <div class="form-group">
                            <label class="form-label">{{ $default_setting->key }} ({{ $default_setting->default }})</label>
                            @if ($default_setting->type == 'select')
                                <select class="form-control" name="{{ $default_setting->key }}">
                                    <option value="">По умолчанию</option>
                                    @foreach (explode(',', $default_setting->values) as $value)
                                        @if ($default_setting->user_value)
                                            <option value="{{ $value }}"
                                                {{ optionSelect($value == $default_setting->user_value) }}>
                                                {{ $value }}</option>
                                        @else
                                            <option value="{{ $value }}"
                                                {{ optionSelect($value == $default_setting->default) }}>
                                                {{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                @if ($default_setting->user_value)
                                    <input class="form-control" type="text" name="{{ $default_setting->key }}"
                                        value="{{ $default_setting->user_value }}">
                                @else
                                    <input class="form-control" type="text" name="{{ $default_setting->key }}"
                                        placeholder="{{ $default_setting->default }}">
                                @endif
                            @endif
                            <div class="form-description">{{ $default_setting->description }}</div>
                        </div>
                    @endforeach

                    <button class="btn btn-primary mt-1" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/settings.js'])
@endsection
