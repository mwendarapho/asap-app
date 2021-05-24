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
}
