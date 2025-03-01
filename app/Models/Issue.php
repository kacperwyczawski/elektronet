<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use SoftDeletes;
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
