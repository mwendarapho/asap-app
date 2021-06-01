<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\DB;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices =Invoice::with('member')->latest('created_at', 'desc')->paginate(10);
        //$invoices = DB::table('invoices')->latest('created_at', 'desc')->with('member')->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = DB::table('members')->select('id', 'fname', 'lname')->orderBy('fname', 'asc')->get();
        //dd($members);
        return view('invoices.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {

        
        
        
        //begin transaction to safeguard against errors.
        
        DB::transaction(function () use ($request){
           
            $data['member_id'] = $request['member_id'];
            $data['invoice_date'] = $request['invoice_date'];
            $data['due_date'] = $request['due_date'];

            $_SESSION['invoice_id'] = Invoice::create($data)->id;
            $id=$_SESSION['invoice_id'];

            $data['description'] = $request['desc'];
            $data['qty'] = $request['qty'];
            $data['amount'] = $request['amount'];
            $data['invoice_id'] =$id;
            Item::create($data);
        }, 3);


        //return response()->json(array('success' => true, 'message' => "Invoiced Saved Successfully"), 200);
        return redirect()->route('invoice.show', $_SESSION['invoice_id'])->with('message','Invoice Saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
       
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
