<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryApiController extends Controller
{

    public function index()
    {
        $category = new Category();
        $categories = $category->getCategory('api');

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
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
