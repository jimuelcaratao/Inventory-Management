<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDescription extends Model
{
    use HasFactory;

    protected $table = 'user_descriptions';
    protected $primaryKey = 'user_description_id';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'user_description_id',
        'user_id',
        'firstname',
        'lastname',
        'middlename',
        'contact',
        'address',
    ];
}
