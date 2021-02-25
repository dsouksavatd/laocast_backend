<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    use HasFactory;

    /**
     * 
     */
    public function getCreatedAtAttribute($value) {
        return date('d-m-Y H:i', strtotime($value));
    }
}
