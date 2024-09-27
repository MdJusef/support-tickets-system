<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'response',
    ];

    public function ticket():BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
