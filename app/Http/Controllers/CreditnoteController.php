<?php

namespace App\Http\Controllers;

use App\Http\Traits\MemberTrait;
use App\Models\Creditnote;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\CreditRequest;


class CreditnoteController extends Controller
{

    use MemberTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits=Creditnote::with('member')->paginate();
        return view('credit_notes.index',compact('credits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $invoices=Invoice::all();
        //->pluck('fname,lname','id')

        $members=$this->allMembers();

        return view('credit_notes.create',compact(['members']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditRequest $request)
    {

        //dd($request->all());
        Creditnote::create($request->validated());
        return redirect()->route('credit.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creditnote  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Creditnote $credit)
    {
      // dd($credit);
        return view('credit_notes.show',compact('credit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creditnote  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Creditnote $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creditnote  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creditnote $credit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creditnote  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creditnote $credit)
    {
        //
    }
}
