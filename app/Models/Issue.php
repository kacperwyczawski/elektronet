<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use SoftDeletes;

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function raisedBy() {
        return $this->belongsTo(User::class, 'raised_by_id');
    }
}
