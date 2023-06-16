@extends('layouts.base')
@section('pagetitle', 'Статус запросов')
@section('body')
    @if ($statuses && $statuses->count())
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Запрос</th>
                        <th data-table-order-row="status" class="table-order">Статус
                            <i class="order-arrows"></i>
                        </th>
                        <th>Сообщение</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statuses as $item)
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
