<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StarlingUser extends Model
{
    protected $fillable = ["customer_uid", "access_token", "refresh_token", "expires_at"];

    public function getExpiresAttribute()
    {
        return $this->expires_at;
    }
}
