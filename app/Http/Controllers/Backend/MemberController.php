<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Member;

class MemberController extends Controller
{

    public function index()
    {
        $members = Member::all();

        // dd($members);
        // dd($members[0]->getPhoneCode);
        return view('admin.member.index')->with(['members'=> $members]);
    }

    public function member_list()
    {
        $members = Member::with('country')->get();

        // dd($members[0]->getPhoneCode);
        return view('admin.member.list')->with(['members'=> $members]);
    }


    public function create()
    {
        return view('admin.member.add');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $member = Member::where(['id' => $id])->get()[0];
        // dd($member[0]->pricing);
        return view('admin.member.view')->with(['members'=> $member]);
    }


    public function edit(Member $member)
    {
        //
    }


    public function update(Request $request, Member $member)
    {
        //
    }


    public function destroy(Member $member)
    {
        //
    }

    public function searchMemberByBarcode(Request $request)
    {
        $barcode = explode('-', $request->barcode);
        $id = $barcode[1];
        $member = Member::where('id', $id)->get()[0];

        // echo json_encode($member);
        return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $member
                ]
            ], apires_code('SUCCESS'));
    }
}
