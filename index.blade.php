@extends('layouts.app')
@section('title', 'Заказы')
@section('content')

    <h1>Заказы</h1>

    <p class="text-right"><a href="{{ route('order.create') }}">Создать заказ</a></p> 

    <table class="table table-hover table-bordered">
        <thead class="table-light">
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Дата и время создания</th>
            <th>Дата и время последнего изменений</th>
            <th>Статус</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>
                    <a href="{{ route('order.show', $order->id) }}">
                    {{ $order->name }}
                    </a>
                </td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $order->updated_at->format('d.m.Y H:i') }}</td>
                <td>
                    @if ($order->status == 0)
                        <span class="text-danger">{{ $statuses[$order->status] }}</span>
                    @elseif (in_array($order->status, [3,]))
                        <span class="text-success">{{ $statuses[$order->status] }}</span>
                    @else
                        {{ $statuses[$order->status] }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    {{ $orders->links() }}
@endsection