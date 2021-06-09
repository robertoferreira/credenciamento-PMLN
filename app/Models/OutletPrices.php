<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OutletPrices extends Model
{
    protected $fillable = [
        'uuid', 'object', 'number', 'published', 'closing',
        'docs', 'status'
    ];
    
}
