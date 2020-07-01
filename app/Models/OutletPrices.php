<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OutletPrices extends Model
{
    protected $fillable = [
        'uuid', 'title', 'number', 'published', 'open',
        'object', 'docs', 'status'
    ];
    
}
