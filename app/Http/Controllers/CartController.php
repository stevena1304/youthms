<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Member;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user()->id;
        
        $totalTransaksi = 0;
        $cart = cart::where('member_id',$user)->get();
        foreach ($cart as $c) {
            $totalTransaksi += $c->quantity * $c->produk->harga;
        }

        $user = auth()->user()->id;
        $member = member::where('user_id',$user)->pluck('id')->first();
        $cart = cart::where('member_id', $member)->get()->sortByDesc('cart.created_at');
        // return $user;
        return view('EU.transaction.cart', compact('cart','totalTransaksi'));
    }


    public function getTotalTransaksi()
    {
        $cart = Cart::all();
        $totalTransaksi = 0;

        foreach ($cart as $c) {
            $totalTransaksi += $c->quantity * $c->produk->harga;
        }

        return response()->json([
            'success' => true,
            'totalTransaksi' => $totalTransaksi,
        ]);
    }


    public function updateQuantity(Request $request)
    {
        $cartId = $request->input('cart_id');
        $newQuantity = $request->input('quantity');

        $cart = Cart::find($cartId);
        if ($cart) {
            $cart->quantity = $newQuantity;
            $cart->save();

            $totalPrice = $cart->quantity * $cart->produk->harga;
            return response()->json(['success' => true, 'item_total_price' => $totalPrice]);
        }

        return response()->json(['success' => false, 'message' => 'Cart not found']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        cart::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
