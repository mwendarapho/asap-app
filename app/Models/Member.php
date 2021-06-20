<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable=[
        'fname',
        'lname',
        'mobile',
        'address',
        'email',
        'dob',
        'spouse_name',
        'spouse_mobile',
        'joined_on',
        'left_on'

    ];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    public function item(){
        return $this->hasManyThrough(Item::class,Invoice::class);
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
