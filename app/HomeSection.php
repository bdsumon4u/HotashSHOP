<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'title', 'type', 'order', 'data',
    ];

    protected $with = ['categories'];

    public static function booted()
    {
        static::deleted(function () {
            cache()->forget('homesections');
        });
    }

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = json_encode($data);
    }

    public function getDataAttribute($data)
    {
        return json_decode($data);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products($paginate = 0)
    {
        $rows = $this->data->rows ?? 3;
        $cols = $this->data->cols ?? 5;
        if ($this->type == 'carousel-grid') {
            $rows *= $cols;
        }
        $query = Product::whereIsActive(1)
            ->whereNull('parent_id')
            ->whereHas('categories', function ($query) {
                $query->whereIn('categories.id', $this->categories->pluck('id')->toArray());
            })
            // ->inRandomOrder()
            ->when(!$paginate, function ($query) use ($rows, $cols) {
                $query->take($rows * $cols);
            });

        return $paginate
            ? $query->paginate($paginate)
            : $query->get();
    }
}
