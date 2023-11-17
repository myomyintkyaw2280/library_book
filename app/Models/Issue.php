<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';
    protected $fillable = ['id', 'member_id', 'total_book', 'note', 'status', 'approved_by', 'approved_at', 'received_by', 'received_at', 'created_at', 'updated_at'];



    public function getIssue()
    {

        //api is frontend api 
        //admin is admin api & web

        $issues = [];

        $issues = Issue::select('*')->with('issueDetails')->get();
        return $issues;
        // if($type === "api")
        // {
        //     foreach($issue as $key => $row){
        //         $issues[$key] = array(
        //             'id'        => $row->id,
        //             'title'     => $row->title,
        //             'overview'      => $row->overview,
        //             'category_id'   => $row->category_id,
        //             'isbn_no'       => $row->isbn_no,
        //             'publisher' => $row->publisher,
        //             'author'    => $row->author,
        //             'image'     => ($row->image != NULL)? base_url($row->image):"",
        //             'published_date' => $row->published_date,
        //             'total_page' => $row->total_page,
        //             'language'      => $row->language,
        //             'is_available' => true,
        //             // "issue_detail" => $row->issueDetails
        //         );
        //     }
        //     return $issues;

        // }else{
        //     // dd($issues);
        //     return $issues;
        // }
    }


    public function createIssue($data = [])
    {
        if(!empty($data) || $data != null){
            $issue = Issue::create($data);
            if($issue){
                return $issue;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getAnIssue($id)
    {

        $issue = Issue::with('issueDetails')->where('id', $id)->get();
        
        return $issue;
    }


    public function updateIssue($input = "")
    {
        if(!empty($input) || $input != null){
            $id = $input->id;
            $name = $input->name;
            $issue = Issue::find($id);

            $issue->name = $name;
            $res = $issue->save();

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
        if (Issue::where('id', '=', $id)->count() > 0) {
           $del = false;
        }
        else {
            $del = Issue::find($id)->delete();
        }

        return $del;
    }




    /*
    *
    *   Eloquent methods
    *
    */

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function issueDetails()
    {
        return $this->hasMany(IssueDetail::class);
    }
}
