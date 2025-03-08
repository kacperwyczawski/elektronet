<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public function achievements()
    {
        return $this->hasMany(CompetitionAchievement::class);
    }
}
