<?php

namespace App\Http\Controllers;

use App\Models\Newsfeed;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsfeedController extends Controller
{
    public function index()
    {
        $neewsfeed = Newsfeed::get();
        return view('newsfeed.index',['newsfeed' => $neewsfeed]);
    }
    public function create()
    {
        return view('newsfeed.add_newsfeed');
    }
    public function edit($id)
    {
        // return view('newsfeed.edit_newsfeed');
        // dd($id);
        $newsfeed = newsfeed::where('id',$id)->first();
        
        return view('newsfeed.edit_newsfeed',['newsfeed' => $newsfeed]);

    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|string|max:255',
            "s_description" => 'required|string|max:255',
            "image" => 'required|mimes:jpeg,png,gif|max:2000',
            "description" => 'required',
        ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/newsfeed'), $imageName);
            
            // dd($request->all());

            $neewsfeed  = new Newsfeed;
            $neewsfeed->name = $request->name;
            $neewsfeed->s_description = $request->s_description;
            $neewsfeed->image = 'images/newsfeed/'.$imageName;
            $neewsfeed->description = $request->description;

            $neewsfeed->save();

            return back()->withSuccess('NewsFeed Successfully Added.');


    }
    public function update(Request $request,$id){
        // dd($request->all());

        $request->validate([
            "name" => 'required|string|max:255',
            "s_description" => 'required|string|max:255',
            "description" => 'required',
        ]);

        $neewsfeed = newsfeed::where('id', $id)->first();

            $neewsfeed->name = $request->name;
            $neewsfeed->s_description = $request->s_description;
            $neewsfeed->description = $request->description;

            $neewsfeed->save();

            return back()->withSuccess('NewsFeed Successfully Updated.');
    }

    public function delete($id){

        $newsfeed = Newsfeed::where('id',$id)->first();
        $newsfeed->delete();

        return back()->withSuccess('NewsFeed Successfully Deleted.');

    }

    public function imageUpdate (Request $request) {

        $request->validate([
            "logo" => "required|mimes:png,jpg,jpeg",
            "id" => "required|integer"
        ]);

        $newsfeed = Newsfeed::findOrFail($request->id);

    
        $file = $request->file('logo');
        if ($request->hasFile('logo')) {    
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $file->move(public_path('images'), $filename); // Move the file to the 'uploads' folder within 'public'
    
           
            if($newsfeed->image != "")
            {
                $fileToDelete = public_path("images/".$newsfeed->image);
                File::delete($fileToDelete);
            }
    
            $newsfeed->image = $filename;
            $newsfeed->save();
    
            return response()->json(["message" => '1'], 200) ;
        }
    
        return response()->json(["message" => '0'], 402) ;
         
    }

    public function apiIndex()
    {
        $newsfeeds = Newsfeed::orderBy("id", "desc")->limit(5)->get();

        foreach ($newsfeeds as $newsfeed)
        {
            $newsfeed->image = asset($newsfeed->image);
        }

        return response()->json([ "newsfeeds" => $newsfeeds ], 200);
    }

    public function allNews(Request $request)
    {
        // get all news by pagination

        $newsfeeds = Newsfeed::orderBy("id", "desc")->paginate(9);
        foreach ($newsfeeds as $newsfeed)
        {
            $newsfeed->image = asset($newsfeed->image);
        }

        return response()->json([ "newsfeeds" => $newsfeeds ], 200);
    }

    public function show(Request $request)
    {
        // validate if id exists
        $request->validate([
            "id" => "required|integer"
        ]);

        $news = Newsfeed::findOrFail($request->id);
        if($news)
        {
            $news->image = asset($news->image);
            return response()->json([ "news" => $news ], 200);
        }

        return response()->json([ "message" => "News not found" ], 404);
    }
    
}
