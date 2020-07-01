<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Company;

class Certificate extends Model
{
    protected $fillable = ['uuid', 'expired_at', 'main_activity' , 'secondary_activity'];

    protected $dateCreatedAt = ['created_at'];

    public function getExpiredAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getCreatedAtAttribute($dateCreatedAt)
    {
        return Carbon::parse($dateCreatedAt)->format('d/m/Y');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
