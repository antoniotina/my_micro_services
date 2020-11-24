<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Get the user that owns the message.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
