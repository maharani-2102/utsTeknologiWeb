<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\D111811015_admin;
use Illuminate\Support\Facades\Validator;

class D111811015_adminController extends Controller
{
    public function index ()
    {
        // get data from table admin
        $admins = D111811015_admin::latest()->get();

        // make response json
        return response() ->json([
            'succes' => true,
            'message' => 'list admin',
            'data' => $admins,
        ], 200);
    }

    public function show ($id)
    {
        // find admin bi id
        $admin = D111811015_admin::findOrfail($id);

        // make response json
        return response () ->json([
            'succes' => true,
            'message' => 'detail admin',
            'data' => $admin
        ], 200);
    }

    public function store (Request $request)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        // save to database 
        $admin = D111811015_admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        , 200]);

        // success save to database
        if($admin) {
            return response()->json([
                'success' => true,
                'message' => 'admin create',
                'data' => $admin
            ], 201);
        }
    }

    public function update (Request $request, admin $admin)
    {
        // set validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // response error validation
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        // find admin by id 
        $admin = D111811015_admin::findOrfail($admin->$id);
        if ($admin){
            
            // update admin
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'admin update',
                'data' => $admin
            ], 200);
        }
    }
   
    public function destroy($id)
    {
        // find admin by id
        $admin = D111811015_admin::findOrfail($admin->$id);
        if ($admin){

            // delete admin
            $admin->delete();

            return response()->json([
                'succes' => true,
                'message' =>'admin delete()',
            ], 200);    
        }

        // data admin not found 
        return response()-json([
            'success' => false,
            'message' => 'admin not found',
        ], 404);
    }
}