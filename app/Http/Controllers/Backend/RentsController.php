<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Books;
use App\Models\Category;
use App\Models\ChangeStatus;
use App\Models\FileUpload;
use App\Models\Issue;
use App\Models\IssueDetail;

class RentsController extends Controller
{
    protected $uploadFolder = "books/cover";
    protected $uploadPdfFolder = "books/pdf";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // $book = Books::orderBy('created_at','DESC')->get();
        $book = new Books();
        $books = $book->getBook('admin');

        return view('admin.rent.index')->with(['books'=> $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.book.add')->with(['category'=> $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        dd($inputs);
        
        $validation = Validator::make($inputs, [
            'member_id' => 'required|string',
            'book_id' => 'required',
        ], [
            'member_id.required' => "Member is required.",
            'book_id.required' => "Book id is required.",
            
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
            // 'overview'      => $request->overview,
            // 'isbn_no'       => $request->isbn_no,
            // 'publisher'     => $request->publisher,
            // 'author'        => $request->author,
            // 'published_date'=> $request->published_date,
            // 'total_page'    => $request->total_page,
            // 'language'      => $request->language,
            // 'barcode'      => $request->barcode,
            // 'image'         => $uploaded_path,
            // 'is_available'  => true,
        ];

        // $book = new Books();
        // $createBook = $book->createBook($data);

        // if($createBook){
        //    return redirect()->back()->withSuccess('Create new book successfully');
        // }else{
        //     return redirect()->back()->withErrors('Fail to create new book!');
        // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $book = Books::find($id);
        $data = Books::find($id);
        $category = Category::all();
        return view('admin.book.edit')->with(['book'=> $data, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $id = $request->id;
        $validation = Validator::make($inputs, [
            'title' => 'required|string',
            'category_id' => 'required|string',
            'overview' => 'required|string',
            'isbn_no' => 'required|string',
            'publisher' => 'required|string',
            'author' => 'required|string',
            'barcode' => 'required|string',
            'published_date' => 'required|string',
            // 'image'         => 'required|mimes:png,jpg|max:2048'
        ], [
            'title.required' => "book title is required.",
            'category_id.required' => "category id is required.",
            'overview.required' => "overview is required.",
            'isbn_no.required' => "isbn number is required.",
            'publisher.required' => "publisher is required.",
            'author.required' => "author is required.",
            'published_date.required' => "published date is required.",
            // 'image.required' => "image is required.",
        ]);

        if ($validation->fails()) {

            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) {
                $error_data[$ekey] = $eval[0];
            }

            return redirect()->back()->withErrors($error_data);
        }


        $uploaded = false; //use old image

        if($request->hasFile('image'))
        {
            $allowedfileExtension   = ['png', 'jpg'];
            $newImage               = $request->file('image');
            
            $uploaded_path  = FileUpload::upload($newImage, $this->uploadFolder);

            if($uploaded_path){

                $uploaded = true;
                $coverImage = $uploaded_path;

                if(file_exists($request->old_image) && file_exists($coverImage)){
                    unlink($request->old_image);
                }
            }
            else{
                // $uploaded = false;
                // $coverImage = $request->old_image;
                
                return redirect()->back()
                    ->withErrors('Fail to upload new book cover image');
            }
        }
        else{
            $uploaded = false;
            $coverImage = $request->old_image;
            // return redirect()->back()
                    // ->withErrors('Book cover image does not have to upload');
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
            'language'      => $request->language,
            'barcode'      => $request->barcode,
            'image'         => $coverImage,
            'is_available'  => true,
        ];

        $book = new Books();
        $createBook = $book->updateBook($data, $id);

        if($createBook){
           return redirect()->route('books.index')
                        ->with('success','book is updated successfully');
        }else{
            return redirect()->back()->withErrors('Fail to create new book!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Books::find($id);
        $del = false;
        if(file_exists($book->image)){
            unlink($book->image);
            $del = $book->delete();
        }
        
        if($del){

            flash()->success('Success', 'book deleted successfully');
                return redirect()->route('books.index')
                        ->with('success');
        }else{
            flash()->error('Error','Your book cannot delete.');

            return redirect()->route('books.index')
                    ->with('error');
        }
    }


    public function book_change_status(Request $request)
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

        $respData = $changeStatus->bookStatus($request->all());
        return response()->json($respData);
    }
}
