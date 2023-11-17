<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['id', 'name', 'status', 'created_at', 'updated_at'];

    public function getCategory($type = "api"){

        //api is frontend api 
        //admin is admin api & web

        $categories = [];

        $category = Category::all();
        if($type === "api")
        {
            $category = Category::select('*')->where('status', '=', 1)->get();
            foreach($category as $key => $row){
                $categories[$key] = array(
                    'id'    => $row->id,
                    'name'  => $row->name,
                );
            }
            return $categories;

        }else{
            // dd($category);
            return $category;
        }
    }


    public function createCategory($data = []){
        if(!empty($data) || $data != null){
            $category = Category::create($data);
            if($category){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getACategory($id){
        // $category = Category::where(['id' => $id])->get();
        $category = Category::find($id);
        $data = [
            'id'    => $category->id,
            'name'  => $category->name
        ];
        return $data;
    }


    public function updateCategory($input = ""){
        if(!empty($input) || $input != null){
            $id = $input->id;
            $name = $input->name;
            $category = Category::find($id);

            $category->name = $name;
            $res = $category->save();

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
        if (Category::where('id', '=', $id)->count() > 0) {
           $del = false;
        }
        else {
            $del = Category::find($id)->delete();
        }

        return $del;
    }
}
