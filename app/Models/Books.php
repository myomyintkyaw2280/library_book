<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FileUpload;

class Books extends Model
{
    use HasFactory;

    protected   $table = 'books';
    protected   $fillable = [
                    'id',
                    'title',
                    'overview',
                    'category_id',
                    'isbn_no',
                    'publisher',
                    'author',
                    'barcode',
                    'image',
                    'published_date',
                    'total_page',
                    'language',
                    'is_available', 
                    'created_at', 
                    'updated_at'
                ];

    public function getBook($type = "api")
    {

        //api is frontend api 
        //admin is admin api & web

        $books = [];

        $book = Books::select('*')->with('issueDetails')->where('is_available', '=', 1)->get();
        if($type === "api")
        {
            foreach($book as $key => $row){
                $books[$key] = array(
                    'id'        => $row->id,
                    'title'     => $row->title,
                    'overview'      => $row->overview,
                    'category_id'   => $row->category_id,
                    'isbn_no'       => $row->isbn_no,
                    'publisher' => $row->publisher,
                    'author'    => $row->author,
                    'image'     => ($row->image != NULL)? base_url($row->image):"",
                    'published_date' => $row->published_date,
                    'total_page' => $row->total_page,
                    'language'      => $row->language,
                    'is_available' => true,
                    // "issue_detail" => $row->issueDetails
                );
            }
            return $books;

        }else{
            // dd($book);
            return $book;
        }
    }


    public function createBook($data = [])
    {
        if(!empty($data) || $data != null){
            $book = Books::create($data);
            if($book){
                return $book;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getABook($id)
    {

        $book = Books::with('issueDetails')->where('id', $id)->get();
        
        return $book;
    }


    public function updateBook($input = "", $id=0)
    {
        // $uploadFolder = "books/cover"; 
        if(!empty($input) || $input != null){
            // $id = $id;
           
            $book = Books::find($id);

            $book->title = $input['title'];
            $book->category_id = $input['category_id'];
            $book->overview = $input['overview'];
            $book->isbn_no = $input['isbn_no'];
            $book->publisher = $input['publisher'];
            $book->author = $input['author'];
            $book->published_date = $input['published_date'];
            $book->total_page = $input['total_page'];
            $book->language = $input['language'];
            $book->barcode = $input['barcode'];
            $book->image = $input['image'];

            $res = $book->save();

            if($res){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function deleteEntry($id) {
        $del = false;
        if (Books::where('id', '=', $id)->count() > 0) {
           $del = false;
        }
        else {
            $del = Books::find($id)->delete();
        }

        return $del;
    }

    /*
    *
    *   Eloquent methods
    *
    */
    public function issueDetails()
    {
        return $this->hasMany(IssueDetail::class);
    }
}
