<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\D111811015_news;
use Illuminate\Support\Facades\Validator;

class D111811015_newsController extends Controller
{
    public function index ()
    {
        // get data from table news
        $news = D111811015_news::latest()->get();

        // make response json
        return response() ->json([
            'succes' => true,
            'message' => 'list news',
            'data' => $news,
        ], 200);
    }

    public function show ($id)
    {
        // find news bi id
        $new = D111811015_news::findOrfail($id);

        // make response json
        return response () ->json([
            'succes' => true,
            'message' => 'detail news',
            'data' => $new
        ], 200);
    }

    public function store (Request $request)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img_url' => 'required',
            'sub_desc' => 'required',
            'desc' => 'required'
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        // save to database 
        $new = D111811015_news::create([
            'title' => $request->title,
            'img_url' => $request->img_url,
            'sub_desc' => $request->sub_desc,
            'desc' => $request->desc
        , 200]);

        // success save to database
        if($new) {
            return response()->json([
                'success' => true,
                'message' => 'data create',
                'data' => $new
            ], 201);
        }
    }

    public function update (Request $request, news $new)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'img_url' => 'required',
            'sub_desc' => 'required',
            'desc' => 'required'
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        // find news by id 
        $new = D111811015_news::findOrfail($new->$id);
        if ($new){
            
            // update news
            $new->update([
                'title' => $request->title,
                'img_ur' => $request->img_url,
                'sub_desc' => $request->sub_desc,
                'desc' => $request->desc
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'news update',
                'data' => $new
            ], 200);
        }
    }
   
    public function destroy($id)
    {
        // find news by id
        $new = D111811015_news::findOrfail($new->$id);
        if ($new){

            // delete news
            $new->delete();

            return response()->json([
                'succes' => true,
                'message' =>'news delete',
            ], 200);    
        }

        // data news not found 
        return response()-json([
            'success' => false,
            'message' => 'news not found',
        ], 404);
    }
}