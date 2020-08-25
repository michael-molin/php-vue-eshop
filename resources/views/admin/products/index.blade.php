<div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <td><a class="btn btn-primary" href="{{route('admin.products.create')}}"> Crea Nuova Pagina</a></td>
                        <td><a class="btn btn-primary" href="{{route('welcome')}}">Torna alla Home</a></td>
                    </tr>
                </table>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Stock</th>
                        <th colspan="3">Azioni</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->stock}}</td>
                            <!-- tramite la relazione presente tra le tabelle e la funzione category nel Model di page posso accedere ai dati della tabella categoria collegata presente nella tabella page -->
                  
                            <td><a class ="btn btn-primary" href="{{route('admin.products.show', $product->id)}}">Visualizza</a></td>
                            <td><a class ="btn btn-secondary" href="{{route('admin.products.edit', $product->id)}}">Modifica</a></td>
                            <td>
                                <!-- Quando si crea il delete, ricordarsi di fare un form, cambiare il method e aggiungere il token  -->
                                <form action="{{route('admin.products.destroy' , $product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Elimina">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
