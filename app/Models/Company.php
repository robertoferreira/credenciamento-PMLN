<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Certificate;

class Company extends Model
{
    protected $fillable = [
        'user_id', 'type', 'provider', 'document', 'name_business', 'share_capital', 'zipcode', 'address',
        'number_address', 'complement', 'neighborhood', 'city',
        'state', 'phone_business', 'docs', 'observation'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
