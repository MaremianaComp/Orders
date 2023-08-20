@extends('layouts.app')
@section('title', $order->id) 
@section('content')

    <h1>Данные по заказу № {{ $order->id }}</h1>

    <p>Название заказа: {{ $order->name }}</p>
    
    <p>Дата и время создания: {{ $order->created_at }}</p>
    <p>Дата и время последнего изменения: {{ $order->updated_at }}</p>

    <p>
        Статус заказа:
        @if ($order->status == 0)
            <span class="text-danger">{{ $statuses[$order->status] }}</span>
        @elseif (in_array($order->status, [3,]))
            <span class="text-success">{{ $statuses[$order->status] }}</span>
        @else
            {{ $statuses[$order->status] }}
        @endif
    </p>

    @if ($order->status == 0)
    @if ($order->created_at->diffInMinutes($current) < 1)
        <p>Заказ может быть завершен через минуту после его создания.</p>
        <p>Cоздан менее минуты назад.</p>         
    @elseif($order->created_at->hour > 12)
      <p>Заказ был создан во второй половине дня.</p>
      <p>Перед завершением его необходимо обязательно подтвердить.</p>
        <form method="post" action="{{ route('order.update', ['order' => $order->id]) }}">
          @csrf
          @method('PATCH')
          <div class="mb-3 form-check">
            <input name="agreement" type="checkbox" class="form-check-input"  value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">Подтвердить</label>
          </div>
          <button type="submit" class="btn btn-primary">Завершить</button>
        </form>
    @else
    <form method="post" action="{{ route('order.update', ['order' => $order->id]) }}">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-primary">Завершить</button>
      </form>
    @endif
    @endif

    <a href="{{ route('orders') }}">{{ __('Назад ко всем заказам') }}</a>

@endsection