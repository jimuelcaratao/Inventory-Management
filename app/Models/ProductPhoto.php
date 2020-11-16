<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $table = 'product_photos';
    protected $primaryKey = 'product_photo_id';

    public $timestamps = true;

    protected $fillable = [
        'product_photo_id',
        'barcode',
        'photo',
    ];
}
