<?php

namespace App\Support\Domain;

use App\Domains\Users\User;
use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends LaravelModel
{
    use UuidTrait;
    use SoftDeletes;

    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
