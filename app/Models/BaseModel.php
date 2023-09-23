<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

abstract class BaseModel extends \Illuminate\Database\Eloquent\Model
{
    use HasUuids;

    protected $casts = [
        'id' => 'string',
    ];
}
