<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id', 'name', 'href', 'order',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder)
        {
            $builder->orderBy('order');
            // $builder->latest('order'); // Not Working
        });
    }
}
