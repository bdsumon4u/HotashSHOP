<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeSection extends Model
{
    protected $fillable = [
        'title', 'type', 'items', 'order', 'data',
    ];

    protected $with = ['categories'];

    protected $casts = [
        'items' => 'array',
    ];

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
        $ids = $this->items ?? [];
        $rows = $this->data->rows ?? 3;
        $cols = $this->data->cols ?? 5;
        if ($this->type == 'carousel-grid') {
            $rows *= $cols;
        }
        $query = Product::whereIsActive(1)->whereNull('parent_id');
        if (($this->data->source??false) == 'specific') {
            $query->whereHas('categories', function ($query) {
                $query->whereIn('categories.id', $this->categories->pluck('id')->toArray());
            })
            ->orWhereIn('id', $ids);
        }
        $query
            // ->inRandomOrder()
            ->when(!$paginate, function ($query) use ($rows, $cols) {
                $query->take($rows * $cols);
            });
        if ($ids) {
            $query->orderByRaw(DB::raw("CASE WHEN id IN (".implode(',', $ids).") THEN 0 ELSE 1 END"));
        }

        return $paginate
            ? $query->paginate($paginate)
            : $query->get();
    }
}
