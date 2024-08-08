<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = "users";
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    protected $casts = [
        'id_user' => 'string'
    ];
    protected $hidden = ['password'];
    protected $fillable = [
        'id_user',
        'id_role',
        'name',
        'email',
        'password',
        'able_login',
        'created_at',
        'updated_at'
    ];
}
