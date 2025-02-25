<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
