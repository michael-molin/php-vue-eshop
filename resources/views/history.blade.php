@extends('layouts.app')
@section('content')
    <div class="container vh">
       @foreach($orders as $order)
        <div class="col-12 box-order">
          <p>Fattura del: <span class="colore">{{$order->created_at}}</span> - Numero:  <span class="colore">{{$order->id}} </span></p>
          <p>Prodotti Acquistati:</p>
          @foreach ($order->products as $product)
          <p>{{$product->name}}</p>
          @endforeach
          <p>IMPORTO TOTALE</p>
          <h2>{{$order->total}}</h2>


        </div>

       @endforeach
    </div>
@endsection

<style media="screen">
  .vh {
    height: 100vh;
    color: white;
  }

  .box-order {
    border: 1px solid black;
    margin: 5px;
    border-radius: 5px;
    padding: 50px;
    color: black;
  }

  .colore {
    color: red;
  }
</style>
