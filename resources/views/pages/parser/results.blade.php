@extends('layouts.base')
@section('pagetitle', 'Результаты запросов')
@section('body')
    @if (count($results))
        <table class="table">
            <thead>
                <tr>
                    <th>Запрос</th>
                    <th>Ответ</th>
                    <th>Модификация</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $item)
                    <tr>
                        <td>{{ $item->request }}</td>
                        <td>{{ $item->response }}</td>
                        <td>{{ $item->modified }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
