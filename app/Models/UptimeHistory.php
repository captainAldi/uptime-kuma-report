<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UptimeHistory extends Model
{
    use HasFactory;

    protected $table    = 'uptime_history';
    protected $guarded  = [];

    
}
