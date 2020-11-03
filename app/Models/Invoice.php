<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'transaction_no';

    public $timestamps = true;

    use HasFactory;
}
