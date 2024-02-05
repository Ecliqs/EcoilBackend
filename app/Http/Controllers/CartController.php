<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
        ]);

        $cart = Cart::where('user_id', $request->user_id)->with(['product'])->get();
        foreach($cart as $c)
        {
            $c->product->image = url('products/'.$c->product->image);
        }

        return response()->json(['cart' => $cart], 200);

    }

    // function to add product to cart
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
        ]);

        $cart = Cart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->get();
        if(count($cart))
        {
            $cart = $cart->first();
            $quantity = $cart->quantity + 1;
            $cart->update([
                'quantity' => $quantity
            ]);
        }
        else
        {
            $cart = Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        
        if($cart) {
            return response()->json(['message' => 'success'], 200);
        }

        return response()->json(['message' => 'failed'], 400);
    }

    // increment quantity of product in cart
    public function quantityIncrement(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|numeric'
        ]);

        $id = $request->cart_id;

        $cart = Cart::find($id);
        $quantity = $cart->quantity + 1;
        
        $updated = $cart->update([
            'quantity' => $quantity
        ]);

        if($updated)
        {
            return response()->json(['message' => 'success'], 200);
        }

        return response()->json(['message' => 'failed'], 400);
    }

    // decrement quantity of product in cart
    public function quantityDecrement(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|numeric'
        ]);
        $id = $request->cart_id;
        $cart = Cart::find($id);
        if($cart->quantity >= 1)
        {
            $quantity = $cart->quantity - 1;
            $updated = $cart->update([
                'quantity' => $quantity
            ]);

            if($updated)
            {
                return response()->json(['message' => 'success'], 200);
            }
            else
            {
                return response()->json(['message' => 'failed'], 400);
            }
        }

        return response()->json(['message' => 'failed'], 400);
        
    }

    public function total(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
        ]);
        $cart = Cart::where('user_id', $request->user_id)->get();
        $total = 0;
        if($cart)
        {
            foreach($cart as $c)
            {
                $total += $c->product->price * $c->quantity;
            }
        }

        return response()->json(['total' => $total], 200);
    }

    public function removeProduct(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|numeric'
        ]);
        $id = $request->cart_id;
        $cart = Cart::find($id);

        if($cart)
        {
            $cart->delete();
            return response()->json(['message' => 'success'], 200);
        }
        else
        {
            return response()->json(['message' => 'failed'], 400);
        }

        
    }

    
}
