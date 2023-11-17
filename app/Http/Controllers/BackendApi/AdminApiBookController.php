<?php

namespace App\Http\Controllers\BackendApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Books;
use App\Models\ChangeStatus;
use App\Models\FileUpload;

class AdminApiBookController extends Controller
{
    protected $uploadFolder = "books/cover";
    protected $uploadPdfFolder = "books/pdf";

    public function index()
    {
        $book = new Books();
        $books = $book->getBook('admin');

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

        $validation = Validator::make($inputs, [
            'title' => 'required|string',
            'category_id' => 'required|string',
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

            return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('VALIDATE_ERROR'),
                    'result' => [
                        'data' => $error_data
                    ]
                ], apires_code('ERROR'));
        }


        $uploaded = false; //use old image

        if($request->hasFile('image'))
        {
            $allowedfileExtension   = ['png', 'jpg'];
            $newImage               = $request->file('image');
            
            $uploaded_path  = FileUpload::upload($newImage, $this->uploadFolder);

            if($uploaded_path){

                $data = [
                    'title'         => $request->title,
                    'category_id'   => $request->category_id,
                    'overview'      => $request->overview,
                    'isbn_no'       => $request->isbn_no,
                    'publisher'     => $request->publisher,
                    'author'        => $request->author,
                    'published_date'=> $request->published_date,
                    'total_page'    => $request->total_page,
                    'barcode'      => $request->barcode,
                    'language'      => $request->language,
                    'image'         => $uploaded_path,
                    'is_available'  => true,
                ];
            }
            else{
                // $data = [
                //     'title'         => $request->title,
                //     'category_id'   => $request->category_id,
                //     'overview'      => $request->overview,
                //     'isbn_no'       => $request->isbn_no,
                //     'publisher'     => $request->publisher,
                //     'author'        => $request->author,
                //     'published_date'=> $request->published_date,
                //     'image'         => "uploads/books/book-default.jpg",
                //     'is_available'  => true,
                // ];
                return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('UPLOAD_ERROR'),
                    'result' => [
                        'data' => $data
                    ]
                ], apires_code('ERROR'));
                
            }
        }
        else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('ERROR'),
                'result' => [
                    'data' => $data
                ]
            ], apires_code('ERROR'));
        }

        $book = new Books();
        $createBook = $book->createBook($data);

       if($createBook){
           return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $createBook
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


    public function show(Request $request)
    {
        
         $inputs = $request->all();

        $validation = Validator::make($inputs, [
            'id' => 'required|numeric',
        ], [
            'id.required' => "Book id is required.",
            'id.numeric' => "Book id must be a value number.",
        ]);

        if ($validation->fails()) {

            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) {
                $error_data[$ekey] = $eval[0];
            }

            return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('VALIDATE_ERROR'),
                    'result' => [
                        'data' => $error_data
                    ]
                ], apires_code('ERROR'));
        }

        $data = [];
        $id = $request->id;
        $book = new Books();
        $data = $book->getABook($id);
        if($data){
            // return view('admin.book.view')->with(['book' => $data]);
            return response()->json([
                    'statusCode' => apires_code('SUCCESS'),
                    'message' => apires_message('SUCCESS'),
                    'result' => [
                        'data' => $data
                    ]
                ], apires_code('SUCCESS'));
        }else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('UPDATE_ERROR'),
                'result' => [
                    'data' =>$data
                ]
            ], apires_code('ERROR'));
        }
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

        $book = new Books();
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


    public function searchBookByBarcodeApi(Request $request)
    {
        $barcode = $request->barcode;

        $book = Books::where('barcode', $barcode)->get()[0];

        // echo json_encode($book);
        return response()->json([
            'statusCode' => apires_code('SUCCESS'),
            'message' => apires_message('SUCCESS'),
            'result' => [
                'data' => $book
            ]
        ], apires_code('SUCCESS'));

    }

    public function destroy($id)
    {
        $book = Books::find($id);
        $del = false;
        
        if(file_exists($book->image)){
            unlink($book->image);
            $del = $book->delete();
        }
        
        if($del){
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
                'message' => apires_message('ERROR'),
                'result' => [
                    'data' => []
                ]
            ], apires_code('ERROR'));
        }
    }
}
