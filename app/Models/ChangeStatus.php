<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Category;
use App\Models\Member;


class ChangeStatus extends Model
{
    use HasFactory;


    public function categoryStatus($request)
    {

        $id = $request['id'];
        $pricing = Category::find($id);
        $pricing->status = $request['status'];
        $res = $pricing->save();

        if($res){
            $data = [
                'statusCode' => 200,
                'status'     => 'success', // error, success, info
                'message'    => 'Successfully updated',
                'title'      => 'Success'
            ];
           // return $data;
        }else{
            $data = [
                'statusCode' => 500,
                'status'     => 'error',
                'message'    => 'Fail to update!',
                'title'      => 'Error'
            ];
        }
        return $data;
    }

    
}
