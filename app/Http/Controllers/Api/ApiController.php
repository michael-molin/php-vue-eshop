<?php

namespace App\Http\Controllers\Api;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Payment;

use App\User;
use App\Order;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts()
    {
        $products= Product::all();
        return response()->json($products);
    }

    public function getCheckout(Request $request)
    {
        $data = $request->getContent();
        $cart = $data->cart;
        $cart = json_decode($cart);
        $paymentMethod = $data->pay->id;
        $paymentMethod = json_decode($paymentMethod);
        $order = new Order;
        $user_id = $cart->intval(userId);
        $order['user_id'] = $user_id;
        $totalPrice = $cart->intval(totalPrice);
        $order['total'] = $totalPrice;
        $order->save();
        
        $user = User::findOrFail($user_idParse);
        try {
            $stripeCharge = $user->charge($totalPrice * 100, $paymentMethod);
            foreach ($cart->listProducts as $product) { // ciclo ci permette di ciclare tutti i componenti dentro cart
                $order->products()->attach($product->id); // dalla TAB order vai alla product e ATTACH l'id del prodotto
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
