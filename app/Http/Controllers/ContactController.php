<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            
            "name" => "required|string",
            "email" => "required|email",
            "phone" => "required|digits:10",
            "service" => "required|string",
            "message" => "nullable|string",
            "address" => "required|string",
            "city" => "required|string",
            "state" => "required|string",
        ]);

        $contact = Contact::create($request->all());

        if($contact)
        {
            return response()->json(["message" => "Stored Successfully"], 200);
        }
       
            return response()->json(["message" => "Failed"], 400);
       
    }

    public function index()
    {
        $contacts = Contact::orderBy("id", "desc")->paginate(20);
        // return $contacts;
        return view("contact.index", ["contacts" => $contacts]);
    }
}
