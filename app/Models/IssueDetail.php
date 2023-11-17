<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueDetail extends Model
{
    use HasFactory;

    protected $table = 'issue_details';
    protected $fillable = ['id', 'issue_id', 'book_id', 'issue_date', 'return_date', 'fee', 'address', 'status', 'approved_by', 'approved_at', 'received_by', 'received_at', 'created_at', 'updated_at'];


    /*
    *
    *   Eloquent methods
    *
    */

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
