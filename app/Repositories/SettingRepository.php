<?php

namespace App\Repositories;

use App\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingRepository
{
    public function set($name, $value)
    {
        return Setting::updateOrCreate(compact('name'), compact('value'));
    }

    public function setMany($data)
    {
        isset($data['logo'])
            && $data = $this->mergeLogo($data);
        $data = collect($data)->map(function ($value, $name) {
            $value = json_encode($value);
            return compact('value', 'name');
        })->toArray();
        DB::table('settings')->insert(array_values($data));
    }

    public function get($name)
    {
        return Setting::where('name', $name)->get() ?? collect([]);
    }

    public function first($name)
    {
        return Setting::where('name', $name)->first() ?? new Setting;
    }

    public function mergeLogo($data)
    {
        $logo = (array)$this->first('logo')->value ?? [];
        foreach ($data['logo'] as $name => $value) {
            $logo[$name] = $value;
        }
        $data['logo'] = $logo;
        return $data;
    }
}
