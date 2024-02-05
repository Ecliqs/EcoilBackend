<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function placeOrder(Request $request)
    {
        $request->validate([
            "user_id" => "required|numeric",
            "address_id" => "required|numeric",
        ]);

        $user_id = $request->user_id;
        $address_id = $request->address_id;
        $total_amount = 0;
        
        try {

        $address = UserAddress::find($address_id);
        $order_id = time()."-".strtoupper(Str::random(4));
        $cart = Cart::where("user_id", $user_id)->get();

        foreach($cart as $item){
            $quantity = $item->quantity;
            $price = $item->product->price;
            $total_amount += $quantity * $price;
        }

        // str random four characters
        $order = [
            "order_id" => $order_id,
            "user_id" => $user_id,
            "address1" => $address->address1,
            "address2" => $address->address2,
            "city" => $address->city,
            "state" => $address->state,
            "country" => $address->country,
            "pincode" => $address->pincode,
            "landmark" => $address->landmark,
            "phone" => $address->phone,
            "total_amount" => $total_amount

        ];

        $ordered = Order::create($order);
        $order_details = [];

        foreach($cart as $item){
            $order_details[] = [
                "order_id" => $ordered->id,
                "product_id" => $item->product_id,
                "price" => $item->product->price,
                "description" => $item->product->description,
                "image" => $item->product->image,
                "quantity" => $item->quantity
            ];
        }

        // insert into order details
        $o_d1 = OrderDetails::insert($order_details);

        // delete items from cart
        foreach($cart as $item){
            $item->delete();
        }

        
        return response()->json(["order" => $order, "order_details" => $o_d1], 200);

            
        } catch (\Throwable $th) {
            throw $th;
            // return response()->json(["message" => "failed"], 400);
        }
        
                

        return response()->json(["user_id" => $request->user_id, "address_id" => $request->address_id], 200);
    }
}
