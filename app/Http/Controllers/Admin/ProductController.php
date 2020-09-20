<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $numRan =  rand ( 0 , 100 );
        $data['user_id'] = Auth::id();
        $data['photo'] = 'https://picsum.photos/500/300?random=' . $numRan; // inseriamo manualmente la photo
        $data['photo2'] = 'https://picsum.photos/500/300?random=' . $numRan; // inseriamo manualmente la photo
        $data['photo3'] = 'https://picsum.photos/500/300?random=' . $numRan; // inseriamo manualmente la photo
        // dd($data);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.products.create')
            ->withErrors($validator)
            ->withInput();
        }

        $product = new Product;
        $product->fill($data);
        $product->save();

        return redirect()->route('admin.products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = Product::findOrFail($id);


      return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = $request->all();
      // dd($data);
      $product = Product::findOrFail($id);

      $validator = Validator::make($data, [
          'name' => 'required|string|max:50',
          'price' => 'required|numeric',
          'description' => 'required|string',
          // 'photo' => 'required|string',
      ]);

      if ($validator->fails()) {
          return redirect()->route('admin.products.edit')
          ->withErrors($validator)
          ->withInput();
      }


      $product->fill($data);
      $product->update();

      return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        // $product->orders()->detach($product->id);

        return redirect()->route('admin.products.index');
    }
}
