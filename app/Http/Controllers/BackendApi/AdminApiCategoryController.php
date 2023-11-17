<?php

namespace App\Http\Controllers\BackendApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class AdminApiCategoryController extends Controller
{

    public function index()
    {
        $category = new Category();
        $categories = $category->getCategory('admin');

        if(!empty($categories)){
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $categories
                ]
            ], apires_code('SUCCESS'));
        }
        else{
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS_NO_DATA'),
                'result' => [
                    'data' => $categories
                ]
            ], apires_code('SUCCESS'));
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            'name' => 'required|string',
        ], [
            'name.required' => "category is required.",
        ]);

        if ($validation->fails()) {

            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) {
                $error_data[$ekey] = $eval[0];
            }

            return redirect()->back()->withErrors($error_data);
        }

        $data = [
            'name'         => $request->name,
            'status'       => 1,
        ];

        $category = new Category();
        $createCat = $category->createCategory($data);

       if($createCat){
           return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => []
                ]
            ], apires_code('SUCCESS'));
        }else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('CREATE_ERROR'),
                'result' => [
                    'data' => []
                ]
            ], apires_code('ERROR'));
        }
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        $inputs = $request->all();
        $id = $request->id;
        // dd($request->price_id);
        $validation = Validator::make($inputs, [
            'name'       => 'required|string',
        ], [
            'name.required'       => "category name is required",
        ]);


        if ($validation->fails()) {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) {
                $error_data[$ekey] = $eval[0];
            }

            return redirect()->back()->withErrors($error_data);
        }

        $category = new Category();
        $input =  $request;
        $res = $category->updateCategory($input);

        if($res){
           return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $categories
                ]
            ], apires_code('SUCCESS'));
        }else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('UPDATE_ERROR'),
                'result' => [
                    'data' => $categories
                ]
            ], apires_code('ERROR'));
        }
    }

    public function destroy($id)
    {
        //
    }
}
