<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'barcode';

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    use HasFactory;
}
