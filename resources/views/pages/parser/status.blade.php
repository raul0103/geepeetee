@extends('layouts.base')

@section('body')
    @if (count($status_data))
        <table>
            <thead>
                <tr>
                    <th>Запрос</th>
                    <th>Статус</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($status_data as $item)
                    <tr>
                        <td>{{ $item->request }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        Нет запросов
    @endif
@endsection
