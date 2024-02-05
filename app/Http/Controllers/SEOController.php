<?php

namespace App\Http\Controllers;

use App\Models\SEO;
use App\Models\Page;
use App\Models\Attribute;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::all();
        $page_id = 0;

        $request->validate([
            "page_id" => "nullable|numeric"
        ]);

        if($request->has("page_id"))
        {
            $page_id = $request->page_id;
        }       

        $meta_data = [];
        if($page_id > 0)
        {
            $meta_data = SEO::where("page_id", $page_id)->with(["attributes"])->get();
        }

        return view("SEO.index", ["pages" => $pages, "page_id" => $page_id, "meta_data" => $meta_data]);
    }

    public function addTag(Request $request)
    {
        $request->validate([
           "page_id" => "required|numeric", 
           "tag" => "required|string"
        ]);

        SEO::create(["page_id" => $request->page_id, "tag_name" => $request->tag]);

        return back();
    }

    public function addAttribute(Request $request)
    {
        $request->validate([
           "s_e_o_id" => "required|numeric", 
           "field" => "nullable|string",
           "value" => "nullable|string",
           "content" => "nullable|string"

        ]);

        $seo = SEO::find($request->s_e_o_id);
        if($seo->tag_name == "title")
        {
            if(count($seo->attributes) )
            {
                $seo->attributes->first()->update(["field" => $request->field, "value" => $request->value, "content" => $request->content]);
            }
            else
            {
            
                Attribute::create(["s_e_o_id" => $request->s_e_o_id, "field" => $request->field, "value" => $request->value, "content" => $request->content]);

            }
        }
        else
        {
            Attribute::create(["s_e_o_id" => $request->s_e_o_id, "field" => $request->field, "value" => $request->value, "content" => $request->content]);
        }

        return back();
    }

    public function deleteAttribute(Request $request)
    {
        $request->validate([
            "attribute_id" => "required|numeric", 
            
        ]);

        Attribute::destroy($request->attribute_id);
        return back();
    }

    public function deleteTag(Request $request)
    {
        $request->validate([
            "s_e_o_id" => "required|numeric", 
            
        ]);

        $seo = SEO::find($request->s_e_o_id);
        
        if($seo->attributes && count($seo->attributes))
        {
            foreach($seo->attributes as $attribute)
            {
                $attribute->delete();
            }
        }

        $seo->delete();
        return back();
    }

    public function getSEOTags( $page)
    {
        $id = 0;

        try {
            if($page !== "")
            {
                $p1 = Page::where("name", $page)->get();
                if(count($p1))
                {
                    $id = Page::where("name", $page)->first()->id;
                $seos = SEO::where("page_id", $id)->with(["attributes"])->get();

                foreach($seos as $seo)
                {
                   $p = $seo->attributes;
                   $a = [];
                   foreach($p as $q)
                   {
                      $a [$q->field] = $q->value;
                   }
                   $seo->a_json = $a;

                   if($seo->tag_name == "title" )
                   {
                       
                       $seo->a_json = [];

                       if( count($seo->attributes) > 0)
                        $seo->content = $seo->attributes->first()->content;
                       else
                        $seo->content = "";

                   }
                   else
                   {
                       $seo->content = "";
                   }
                }
                 return response()->json(["seos" => $seos], 200);
                }
                 

            }
        } catch (\Throwable $th) {
            throw $th;
        }

        
        
    }
}
