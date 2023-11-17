<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\ChangeStatus;
use App\Models\FileUpload;

class CategoryController extends Controller
{
    protected $uploadFolder = "category"; //if it has image

    public function index()
    {
        $category = new Category();
        $categories = $category->getCategory('admin');
        return view('admin.category.index')->with(['categories'=> $categories]);
    }

    public function create()
    {
        return view('admin.category.add');
    }


    // public function store(Request $request)
    // {
    //     $inputs = $request->all();

    //     $validation = Validator::make($inputs, [
    //         'name' => 'required|string',
    //     ], [
    //         'name.required' => "category is required.",
    //     ]);

    //     if ($validation->fails()) {

    //         $error_data = [];
    //         $verror = $validation->errors()->toArray();

    //         foreach($verror as $ekey =>$eval) {
    //             $error_data[$ekey] = $eval[0];
    //         }

    //         return redirect()->back()->withErrors($error_data);
    //     }

    //     $banner = Category::create([
    //         'name'         => $request->name,
    //         'status'       => 1,
    //     ]);

    //    if($banner){
    //        return redirect()->route('category.index')
    //             ->withSuccess('Successfully created category data');
    //     }else{
    //         return redirect()->back()
    //             ->withErrors('Fail to create category data');
    //     }
        
    // }


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

        // $category = Category::create([
        //     'name'         => $request->name,
        //     'status'       => 1,
        // ]);

        $data = [
            'name'         => $request->name,
            'status'       => 1,
        ];

        $category = new Category();
        $createCat = $category->createCategory($data);

       if($createCat){
           return redirect()->route('category.index')
                ->withSuccess('Successfully created category data');
        }else{
            return redirect()->back()
                ->withErrors('Fail to create category data');
        }
        
    }


    public function show($id)
    {
        $category = Category::where(['id' => $id])->get();
        // dd($category[0]->pricing);
        return view('admin.category.view')->with(['categories'=> $category]);
    }


    public function edit($id)
    {
        // $category = Category::where(['id' => $id])->get();
        $category = new Category();
        $data = $category->getACategory($id);
        // dd($data);
        return view('admin.category.edit')->with(['category'=> (object)$data]);
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
            return redirect()->route('category.index')
                        ->with('success','category is updated successfully');
        }else{
            return redirect()->route('category.index')
                        ->with('fails','Fail to update category!');
        }
    }


    public function destroy($id)
    {
        $del = Category::find($id)->delete();

        if($del){
            flash()->success('Success', 'Successfully deleted category');
            return redirect()->route('category.index')
                    ->with('success');
        }else{
            flash()->error('Error','This category cannot delete.');

            return redirect()->route('category.index')
                    ->with('error');
        }
    }


    public function category_change_status(Request $request)
    {
        $inputs = $request->all();
        $validation = Validator::make($inputs, [
            'id'       => 'required|string',
            'status'       => 'required|string'
        ], [
            'id.required'  => "Reward price id is required",
            'status.required'  => "Reward status is required"
        ]);

        if ($validation->fails()) {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) {
                $error_data[$ekey] = $eval[0];
            }

            return response()->json([
                'message' => 'Validation Error',
                'data' => $error_data
            ]);
        }

        $changeStatus = new ChangeStatus();

        $respData = $changeStatus->categoryStatus($request->all());
        return $respData;

    }


}
