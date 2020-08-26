<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h1>{{$product->name}}</h1>
            <h2>{{$product->id}}</h2>
            <p>{{$product->price}}</p>
            <p>{{$product->description}}</p>
            <p>{{$product->stock}}</p>
            <img src="{{$product->photo}}" alt="">
        </div>
    </body>
</html>

<style>
    .container {
        display: flex;
        justify-content:center;
        align-items: center;
        flex-direction: column;
    }
</style>
