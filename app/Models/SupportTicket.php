<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    public function replays()
    {
        return $this->hasMany(SupportTicketReplay::class, 'ticket_id', 'id');
    }
}
