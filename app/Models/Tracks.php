<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracks extends Model
{
    use SoftDeletes; 
    use HasFactory;

    /**
     * 
     */
    public function Channel() {
        return $this->hasOne(Channels::class, 'id', 'channels_id');
    }

    /**
     * 
     */
    public function getCreatedAtAttribute($value) {
        return date('d-m-Y H:i', strtotime($value));
    }
}
