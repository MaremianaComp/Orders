@extends('layouts.app') 
@section('title', 'Создание заказа') 
@section('content') 

<form action="{{ route('order.store') }}" method="POST"> 
 @csrf 
 <div class="mb-3"> 
 <label for="txtName" class="form-label">Название заказа</label> 
 <input name="name" id="txtName" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"> 
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror 
 </div> 
 <input type="submit" class="btn btn-primary" value="Создать"> 
</form> 

@endsection