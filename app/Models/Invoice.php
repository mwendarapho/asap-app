<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable=[
        'member_id',
        'due_date' ,
        'amount' ,
        'description',
        'invoice_no',
    ];
}
