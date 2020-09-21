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
        foreach($data as $name => $value) {
            $this->set($name, $value);
        }
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
