<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StarlingUser extends Model
{
    protected $fillable = ["customer_uid", "access_token", "refresh_token", "expires_at"];
    protected $appends = array('expires');

    public function getExpiresAttribute()
    {
        return $this->expires_at;
    }
}
