<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- cdn bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          @foreach ($errors->all() as $message)
              {{$message}}
          @endforeach
          <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="price">Prezzo</label>
                <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" id="stock" class="form-control" value="{{old('stock')}}">
            </div>
            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control" value="{{old('description')}}"></textarea>
            </div>
            <div class="new-photo">
                <label for="photo">Aggiungi nuova foto: </label>
                <input type="file" name="photo" id="photo">
            </div>
            <input class="btn btn-primary" type="submit" value="Salva">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
