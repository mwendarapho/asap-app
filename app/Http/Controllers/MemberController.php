<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public $members;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

       $members= Member::paginate(10);
       return view('members.index',compact('members'));
    }
    public function current()
    {
        $members= DB::table('members')->where('status','=',true)->paginate(10);

        return view('members.index',compact('members'));
    }
    public function past()
    {
        $members= DB::table('members')->where('status','=',false)->paginate(10);
        return view('members.index',compact('members'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest  $request)
    {
        Member::create($request->validated());
        //return redirect('member')->with('message','Member added successfully');
        return view('members.create')->with('message','Member added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('members.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //dd($member);
        return view('members.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        //dd($request->left_on);
        $data=$request->validated();
        ($request->left_on!='')? $data['status']=false: $data['status']=true;

        //dd($data);
        $member->update($data);
        return redirect()->route('member.show',compact('member'))->with(['message'=>'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        redirect()->route('member.index')->with(['message'=>'member deleted successfully']);
    }

    public function fileImportExport()
    {
        return view('members.file-import');
    }

    public function fileImport(Request $request)
    {
        Excel::import(new MembersImport, $request->file('file')->store('temp'));
        return back()->with(['message'=>'Imported successfully']);
    }
}
