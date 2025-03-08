<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionAchievement extends Model
{
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
