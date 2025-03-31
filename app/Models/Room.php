<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
