<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = ['id'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
