<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repositories\SettingRepository;
use App\Traits\ImageUploader;

class SettingController extends Controller
{
    use ImageUploader;

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SettingRequest $request, SettingRepository $settingRepo)
    {
        if ($request->isMethod('GET')) {
            $data = Setting::all()->flatMap(function ($setting) {
                return [$setting->name => $setting->value];
            });
            return $this->view($data);
        }

        $data = $request->validated();
        
        if (isset($data['logo'])) {
            foreach ($data['logo'] as $type => $file) {
                $data['logo'][$type] = $this->upload($file, $type);
            }
        }

        $settingRepo->setMany($data);
        return back()->withSuccess('Settings Has Been Updated.');
    }
    public function all($keys = null)
    {
        $data = parent::all();
        if ($this->isMethod('GET')) {
            return $data;
        }

        foreach ($data['logo'] as $type => $file) {
            $data['logo'][$type] = $this->upload($file, $type);
        }
        return $data;
    }

    protected function upload($file, $type)
    {
        if ($type == 'desktop') {
            return $this->uploadImage($file, [
                'dir' => 'logo',
                'width' => config('services.logo.desktop.width', 260),
                'height' => config('services.logo.desktop.height', 54),
            ]);
        }

        if ($type == 'mobile') {
            return $this->uploadImage($file, [
                'dir' => 'logo',
                'width' => config('services.logo.mobile.width', 192),
                'height' => config('services.logo.mobile.height', 40),
            ]);
        }

        if ($type == 'favicon') {
            return $this->uploadImage($file, [
                'dir' => 'logo',
                'resize' => false,
                'width' => config('services.logo.favicon.width', 56),
                'height' => config('services.logo.favicon.height', 56),
            ]);
        }
    }
}
