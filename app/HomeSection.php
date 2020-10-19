<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'title', 'type', 'order', 'data',
    ];

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

    public function products($limited = true, $paginate = 0)
    {
        $categories = $this->categories->pluck('id')->toArray();
        $query = Product::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        })
        ->inRandomOrder()
        ->when($limited, function ($query) {
            $query->take(5);
            // $query->take(config('services.products_count.'.$this->type, 20));
        });

        return $paginate
            ? $query->paginate($paginate)
            : $query->get();
    }
}
