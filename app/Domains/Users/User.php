<?php

namespace App\Domains\Users;

use App\Domains\Areas\Area;
use App\Support\Domain\UuidTrait;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use UuidTrait;
    use SoftDeletes;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param string $value
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = mb_strtolower($value);
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $areas = [
                [
                    'name' => 'Saúde',
                    'comments' => 'Acompnhamento de minha saúde',
                    'icon' => 'pulse',
                ],
                [
                    'name' => 'Finanças',
                    'comments' => 'Posição financeira',
                    'icon' => 'star',
                ],
                [
                    'name' => 'Relacionamentos',
                    'comments' => 'Amizades',
                    'icon' => 'beer',
                ],
                [
                    'name' => 'Amor',
                    'comments' => 'Histórias de amor',
                    'icon' => 'heart',
                ],
            ];
            $user->areas()->createMany($areas);
        });
    }
}
