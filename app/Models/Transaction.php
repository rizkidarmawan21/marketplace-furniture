<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $with = ['details', 'shipping'];


    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    public function shipping()
    {
        return $this->hasOne(TransactionShipping::class, 'transaction_id');
    }
}
