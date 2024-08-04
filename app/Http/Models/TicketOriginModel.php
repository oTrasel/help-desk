<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketOriginModel extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_ticket_origin';
    protected $table = 'ticket_origin';
    protected $fillable = [
        'id_ticket_origin',
        'ticket_origin',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'ticket_origin' => ''
    ];
    protected $casts = [
        'ticket_origin' => 'string'
    ];
}
