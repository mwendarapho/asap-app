<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable=[
        'member_id',
        'invoice_date',
        'due_date' ,
    ];


    public function member(){
        return $this->belongsTo(Member::class);
    }

    public function item(){
        return $this->hasMany(item::class);
    }
}
