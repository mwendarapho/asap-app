<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paymode extends Model
{
    use HasFactory;
    protected $fillable = ['name',];



    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
