<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditnote extends Model
{
    use HasFactory;

    protected  $fillable=[
        'member_id',
        'invoice_id',
        'amount',
        'credit_date',
        'credit_ref',
    ];
    public function member(){
        return $this->belongsTo(Member::class);
    }
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
}
