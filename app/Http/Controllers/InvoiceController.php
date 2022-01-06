<?php

namespace App\Http\Controllers;

use App\Imports\InvoicesImport;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\MemberTrait;
use Maatwebsite\Excel\Facades\Excel;



class InvoiceController extends Controller
{
    use MemberTrait;

    //begin transaction to safeguard against errors.
    public function createInvoice($request)
    {
        DB::transaction(function () use ($request) {

            $data['member_id'] = $request['member_id'];
            $data['invoice_date'] = $request['invoice_date'];
            $data['due_date'] = $request['due_date'];

            $_SESSION['invoice_id'] = Invoice::create($data)->id;
            $id = $_SESSION['invoice_id'];

            $data['description'] = $request['desc'];
            $data['qty'] = $request['qty'];
            $data['amount'] = $request['amount'];
            $data['invoice_id'] = $id;
            Item::create($data);
        }, 3);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $invoices = "select T1.id as docno,T1.member_id,T1.due_date as date ,T1.invoice_date as inv_date, sum(T2.qty*T2.amount) as amount,'INV' as doctype, T3.fname, T3.lname
        from invoices T1
        join items T2 on T1.id=T2.invoice_id
        join members T3 on T1.member_id=T3.id
        group by T2.invoice_id";
        $invoices = DB::select(DB::raw($invoices));
        //dd($invoices);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = $this->currentMembers();
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
        //check if to invoice all members
        if ($request['member_id'] == 000) {
            $ids = Member::where('status', '=', true)->pluck('id');
            foreach ($ids as $id) {
                $request['member_id'] = $id;
                $this->createInvoice($request);
            }

            //dd($request);
        } else {
            $this->createInvoice($request);
        }

        //return response()->json(array('success' => true, 'message' => "Invoiced Saved Successfully"), 200);
        return redirect()->route('invoice.show', $_SESSION['invoice_id'])->with('message', 'Invoice Saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //dd($invoice->id);
        //DB::enableQueryLog();
    
        $invoice_data=DB::table('invoices')
        ->select('member_id','invoice_date')
        ->where('id', '=', $invoice->id)
        ->get();

        $member_id=$invoice_data[0]->member_id;
        $invoice_date=$invoice_data[0]->invoice_date;
              

        $data=$this->memberSummaryStatement($invoice_date, $member_id);

        $transactions=$data['transactions'];
        $balBF=$data['balBF'];

        $totalinvoice = Invoice::count();
    

        $items = DB::table('items')
            ->select('qty', 'description', 'amount')
            ->where('invoice_id', '=', $invoice->id)
            ->get();



        return view('invoices.show', compact(['invoice', 'items', 'totalinvoice','transactions','balBF']));
        //$log = DB::getQueryLog();
        //dump($log);
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
    public function importInvoice()
    {
        return view('invoices.file-import');
    }

    public function fileImport(Request $request)
    {
        Excel::import(new InvoicesImport, $request->file('file')->store('temp'));
        //Excel::import(new InvoicesImport, 'temp/invoices_all_13_21.txt');
        return back()->with(['message'=>'Imported successfully']);
    }
}
