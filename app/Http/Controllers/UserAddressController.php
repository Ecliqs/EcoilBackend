<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'address1' => 'required|string',
            'address2' => 'nullable',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pincode' => 'required|digits:6',
            'landmark' => 'nullable|string',
            "phone" => "required|digits:10",
        ]);

        // if validation passed, create user address
        $userAddress = UserAddress::create($request->all());
        
        if($userAddress) {
            return response()->json(['message' => 'success'], 200);
        }

        return response()->json(['message' => 'failed'], 400);
        
    }


    public function index(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric'
        ]);
        $userAddresses = UserAddress::where('user_id', $request->user_id)->get();

        if($userAddresses)
        {
            return response()->json(['userAddresses' => $userAddresses], 200);
        }
        else
        {
            return response()->json(['message' => 'failed'], 400);
        }
    }

    // function to delete user address
    public function destroy($id)
    {
        $userAddress = UserAddress::find($id);
        if($userAddress)
        {
            $userAddress->delete();
            return response()->json(['message' => 'success'], 200);
        }
        else
        {
            return response()->json(['message' => 'failed'], 400);
        }
    }
}
