<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Http\Traits\MemberTrait;

class MemberInvoice extends Component
{
    use MemberTrait;
    public $invoices="";
    public $member_id;
    protected $queryString = ['member_id'];
    public $members;

    public function render()
    {

        $this->invoices = DB::table('invoices')
            ->where('member_id', '=', $this->member_id)
            ->select('id')
        ->get();
        $this->members=$this->allMembers();

        return view('livewire.member-invoice');
    }
}




