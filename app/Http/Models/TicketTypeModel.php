<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTypeModel extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id_ticket_type';
    protected $table = 'ticket_type';
    protected $fillable = [
        'id_ticket_type',
        'ticket_type',
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'ticket_type' => ''
    ];
    protected $casts = [
        'ticket_type' => 'string'
    ];
}
