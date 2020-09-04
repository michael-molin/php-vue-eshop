@extends('layouts.app')
@section('content')
    <div class="container">
       @foreach($orders as $order)
            <h2>{{$order->total}}</h2>
            @foreach ($order->products as $product)  
                <p>{{$product->name}}</p>
            @endforeach
            
       @endforeach
    </div>
@endsection