<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $table = 'user_photos';
    protected $primaryKey = 'user_photo_id';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'user_photo_id',
        'user_id',
        'photo',
    ];
}
