<?php

namespace Modules\Api\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JWTUser extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'customers';
    // Rest omitted for brevity
    protected $fillable = ["email","user_name", "full_name","google_id"];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * FullName
     *
     * @return void
     */
    public function getFullNameAttribute()
    {
        // return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
        return $this->full_name;
    }
}
