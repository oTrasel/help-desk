<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPriorityModel extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_ticket_priority';
    protected $table = 'ticket_priority';
    protected $fillable = [
        'id_ticket_priority',
        'ticket_priority',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'ticket_priority' => ''
    ];
    protected $casts = [
        'ticket_priority' => 'string'
    ];
}
