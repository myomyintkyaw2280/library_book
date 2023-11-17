<?php

namespace App\Http\Controllers\BackendApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Issue;
use App\Models\ChangeStatus;
use App\Models\FileUpload;

class AdminApiIssuesController extends Controller
{
    protected $uploadFolder = "books/cover";
    protected $uploadPdfFolder = "books/pdf";

    public function index()
    {
        $book = new Issue();
        $books = $book->getIssue();

        if(!empty($books)){
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $books
                ]
            ], apires_code('SUCCESS'));
        }
        else{
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS_NO_DATA'),
                'result' => [
                    'data' => $books
                ]
            ], apires_code('SUCCESS'));
        }
    }

    public function store(Request $request)
    {
        $inputs = $request->all();


        // `member_id`, `total_book`, `note`,
        $validation = Validator::make($inputs, [
            'member_id' => 'required|string',
            'n' => 'required|string',
            'overview' => 'required|string',
            'isbn_no' => 'required|string',
            'publisher' => 'required|string',
            'author' => 'required|string',
            'published_date' => 'required|string',
            'image'         => 'required|mimes:png,jpg|max:2048'
        ], [
            'title.required' => "book title is required.",
            'category_id.required' => "category id is required.",
            'overview.required' => "overview is required.",
            'isbn_no.required' => "isbn number is required.",
            'publisher.required' => "publisher is required.",
            'author.required' => "author is required.",
            'published_date.required' => "published date is required.",
            'image.required' => "image is required.",
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
            'title'         => $request->title,
            'category_id'   => $request->category_id,
            'overview'      => $request->overview,
            'isbn_no'       => $request->isbn_no,
            'publisher'     => $request->publisher,
            'author'        => $request->author,
            'published_date'=> $request->published_date,
            'total_page'    => $request->total_page,
            'image'         => $uploaded_path,
            'is_available'  => true,
        ];

        $book = new Issue();
        $createIssue = $book->createIssue($data);

       if($createIssue){
           return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $createIssue
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

        $book = new Issue();
        $input =  $request;
        $res = $book->updateBook($input);

        if($res){
           return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $books
                ]
            ], apires_code('SUCCESS'));
        }else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('UPDATE_ERROR'),
                'result' => [
                    'data' => $books
                ]
            ], apires_code('ERROR'));
        }
    }

    public function destroy($id)
    {
        //
    }
}
