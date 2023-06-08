@extends('layouts.base')
@section('pagetitle', 'Статус запросов')
@section('body')
    @if (count($status_data))
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
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->message }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Нет запросов
    @endif
@endsection
