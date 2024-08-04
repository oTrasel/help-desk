<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_role';
    protected $table = 'roles';
    protected $fillable = [
        'id_role',
        'role',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'role' => ''
    ];
    protected $casts = [
        'role' => 'string'
    ];
}
