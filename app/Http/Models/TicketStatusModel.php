<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatusModel extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_ticket_status';
    protected $table = 'ticket_status';
    protected $fillable = [
        'id_ticket_status',
        'ticket_status',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'ticket_status' => ''
    ];
    protected $casts = [
        'ticket_status' => 'string'
    ];
}
