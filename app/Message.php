<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }
}
