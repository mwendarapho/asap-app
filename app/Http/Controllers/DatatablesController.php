<?php

namespace App\Http\Controllers;

use App\Http\Traits\MemberTrait;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\DataTables\MemberDataTable;


class DatatablesController extends Controller
{
    use MemberTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getAllMembers()
    {
        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><i class="far fa-arrow-alt-circle-right"></i> More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }

    public function currentMembers()
    {
        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->where('status', '=', true)
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><i class="far fa-arrow-alt-circle-right"></i> More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }

    public function pastMembers()
    {
        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->where('status', '=', false)
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><i class="far fa-arrow-alt-circle-right"></i> More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }

    public function getSahayak()
    {
        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->where('category_id', '=', 1)
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><i class="far fa-arrow-alt-circle-right"></i> More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }

    public function getFullMember()
    {
        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->where('category_id', '=', 2)
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><i class="far fa-arrow-alt-circle-right"></i> More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }

    public function getPaidUpMember()
    {
       $data=[];
       $members=$this->allMembers();
        $last_day_of_feb=Carbon::now()->month(2)->lastOfMonth()->toDateString();
        //$last_day_of_feb= $this->paid_up_date;

        //dd($members);

        foreach($members as $member) {
            $res=$this->balanceBroughtForward($last_day_of_feb, $member->id);
           // print_r($res);
            if (($res['credit']-$res['debit'])>=0) {
                array_push($data,$member->id);
            }
            //print_r($data);

        }

        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->whereIn('members.id', $data)
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><span data-feather="arrow-right-circle" class="small text-success"></span>More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }
    public function getMembersWithBalances()
    {

        $data=[];
        $members=$this->allMembers();
        $last_day_of_feb=Carbon::now()->month(2)->lastOfMonth()->toDateString();
       // $last_day_of_feb='2022-02-28';

        foreach($members as $member) {
            $res=$this->balanceBroughtForward($last_day_of_feb, $member->id);
            if (($res['credit']-$res['debit'])<0) {
                array_push($data,$member->id);
            }

        }
        $query = DB::table('members')
            ->join('categories', 'categories.id', '=', 'members.category_id')
            ->whereIn('members.id', $data)
            ->select('members.id', 'members.fname', 'members.lname', 'members.mobile', 'members.email', 'members.status', 'categories.name');
        return DataTables::of($query)
            ->editColumn('status', '{{ ($status? "active" : "inactive") }}')
            ->addColumn('show', '<a class="btn btn-outline-primary btn-sm" href="member/{{$id}}" ><span data-feather="arrow-right-circle" class="small text-success"></span>More</a>')
            ->addColumn('del', '<a class="btn btn-outline-danger btn-sm" id="delete-member" href="member/{{$id}}"><i class="fas fa-trash-alt"></i> Del</a>')
            ->rawColumns([
                'show', 'del'
            ])
            ->make(true);

    }

    public function index(MemberDataTable $dataTable)
    {

        //dd($dataTable);

        return $dataTable->render('members.vio');
    }
}
