<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscriber extends Model
{
    protected $guarded = [];

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
