@extends('layouts.base')
@section('pagetitle', 'Статус запросов')
@section('body')
    @if (count($status_data))
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Запрос</th>
                        <th>Статус</th>
                        <th>Сообщение</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($status_data as $item)
                        <tr>
                            <td>{{ $item->request }}</td>
                            <td>
                                <span class="badge {{ getBadgeColor($item->status) }}">
                                    {{ $item->status }}</span>
                            </td>
                            <td>{{ $item->message }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="controls-container">
            <button class="btn btn-danger" data-status-delete-all>Очистить</button>
        </div>
    @else
        Нет запросов
    @endif
@endsection

@section('scripts')
    @vite('resources/js/pages/parser.js')
@endsection
