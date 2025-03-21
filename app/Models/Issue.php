<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignment()
    {
        return $this->hasOne(IssueAssignment::class);
    }
}
