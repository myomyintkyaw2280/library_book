<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\Category;
use App\Models\Books;

use App\Models\IssueDetail;

class AdminController extends Controller
{

 
    public function index()
    {

        // dd(auth()->user()->role('Administrator'));

        $currentDate = Carbon::now();
        
        $today = $currentDate->format('Y-m-d');

        //Dashboard statistics 
        $total_member = Member::count();
        $total_category = Category::count();

        $total_book = Books::whereDate('created_at', '=', $today)->count();
        $return_book = IssueDetail::where(['return_date'=> $today, 'status' => 1])->count();;
        return view('admin.index')->with([
            'total_member' => $total_member, 
            'total_category' => $total_category,
            'total_book' => $total_book,
            'return_book' => $return_book,
        ]);
    }

}
