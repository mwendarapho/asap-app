<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'member_id',
        'pay_date',
        'ref',
        'paymode_id',
        'amount',

    ];

    public function member(){
        return $this->belongsTo(Member::class);
        }

        public function paymode(){
            return $this->belongsTo(Paymode::class);
        }
}
