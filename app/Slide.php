<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'img_src', 'title', 'text', 'btn_name', 'btn_href', 'is_active',
    ];

    public function getSrcAttribute() {
        return asset($this->img_src);
    }
}
