<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCommentaryModel extends Model
{
    use HasFactory;

    protected $table = "usuario";
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    protected $casts = [
        'id_user' => 'string'
    ];
    protected $hidden = ['senha', 'cpf'];
    protected $fillable = [
        'id_user',
        'nome',
        'email',
        'senha',
        'cpf',
        'dt_cadastro',
        'dt_alteracao'
    ];
}
