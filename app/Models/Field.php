<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends Model
{
    protected $guarded = [];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }
}
