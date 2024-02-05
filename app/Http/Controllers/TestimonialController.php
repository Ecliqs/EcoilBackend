<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        $testimonial = Testimonial::get();
        return view('testimonial.index',['testimonial' => $testimonial]);
    }
    // public function approve($id){
    //     $testimonial = Testimonial::findOrFail($id);
    //     $testimonial->status = 1; //Approved
    //     $testimonial->save();
    //     return redirect()->back(); //Redirect user somewhere
    //  }
     public function decline($id){
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = 0; //Declined
        $testimonial->save();
        return redirect()->back(); //Redirect user somewhere
     }

     public function store(Request $request)
     {
        sleep(5);
        // return response()->json(["message" => $request->all(), "image" => $imageName]);
        $request->validate([
            "name" => "required",
            "company" => "required",
            "review" => "required",
            "image" => "nullable|mimes:png,jpg",
        ]);

        if($request->has("image"))
        {
            $image = $request->file('image');
            $imageName = Str::random(40).".".$image->getClientOriginalExtension();
            $image->move(public_path('images/testimonials/'), $imageName);
        }
        
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->company = $request->company;
        $testimonial->review = $request->review;
        $testimonial->image = 'images/testimonials/'.$imageName;
        $testimonial->approved = 0;        
        $testimonial->save();
        
        return response()->json(["message" => "Stored Successfully"], 200);
    }

    public function apiIndex()
    {
        $testimonials = Testimonial::orderBy("id", "desc")->where("approved", 1)->limit(5)->get();
    
        foreach ($testimonials as $testimonial) {
            if($testimonial->image != "")
            {
                $testimonial->image = url($testimonial->image);
            }
        }

        return response()->json(["testimonials" => $testimonials], 200);
    }

    public function approve(Request $request)
    {
        $request->validate([
            "id" => "required|numeric",
            "data" => "required|numeric",
        ]);

        $id = $request->id;
        $data = $request->data;
        
        $testimonial = Testimonial::findOrFail($id);
        if($data == 0 || $data == 1) {
            $testimonial->approved = $data; //Approved
            $testimonial->save();
        }
        
        return response()->json(["status" => "1"], 200);
    }
}
