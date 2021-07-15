<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\MemberTrait;

class HomeController extends Controller
{
    use MemberTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $data= $this->balanceBroughtForward(Carbon::tomorrow(),00);
      // dd($data);

        return view('home',compact('data'));
    }
}
