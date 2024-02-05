<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function index()
    {
        $product = Product::get();
        return view('product.index',['product' => $product]);
    }

    public function create()
    {
        return view('product.add_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|string|max:255',
            "price" => 'required|string|max:255',            
            "image" => 'required|mimes:jpeg,png,gif|max:1000',
            "description" => 'nullable|string|max:255',
        ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            
            // dd($request->all());

            $product  = new Product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->image = $imageName;
            $product->description = $request->description;

            $product->save();

            return back()->withSuccess('Product Successfully Added.');


    }
    public function edit($id)
    {
        // dd($id);
        $product = product::where('id',$id)->first();
        
        return view('product.edit_product',['product' => $product]);

    }

    public function update(Request $request,$id){
        // dd($request->all());

        $request->validate([
            "name" => 'required|string|max:255',
            "price" => 'required|numeric|max:255',
            // "stock" => 'required|string|max:255',
            "description" => 'nullable|string|max:255',
        ]);

        $product = Product::where('id', $id)->first();

            $product->name = $request->name;
            $product->price = $request->price;
            // $product->stock = $request->stock;
            $product->description = $request->description;

            $product->save();

            return back()->withSuccess('Product Successfully Updated.');
    }

    public function delete($id){

        $product = Product::where('id',$id)->first();
        $product->delete();

        return back()->withSuccess('Product Successfully Deleted.');

    }

    public function imageUpdate (Request $request) {

        $request->validate([
            "logo" => "required|mimes:png,jpg,jpeg",
            "id" => "required|integer"
        ]);

        $product = Product::findOrFail($request->id);

    
        $file = $request->file('logo');
        if ($request->hasFile('logo')) {    
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('products'), $filename); // Move the file to the 'uploads' folder within 'public'
    
           
            if($product->image != "")
            {
                $fileToDelete = public_path("products/".$product->image);
                File::delete($fileToDelete);
            }
    
            $product->image = $filename;
            $product->save();
    
            return response()->json(["message" => '1'], 200) ;
        }
    
        return response()->json(["message" => '0'], 402) ;
         
    }


    // write a function to send all the product to response
    public function apiIndex()
    {

        // get products using pagination
        $products = Product::paginate(3);
        // change image url of product  to public path
        foreach($products as $product){
            $product->image = url('products/'.$product->image);
        }
        
        return response()->json( ['products' => $products] );
    }
}
