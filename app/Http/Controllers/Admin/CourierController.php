<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;
use App\Setting;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index(Request $request, SettingRepository $settingRepo)
    {
        return view('admin.couriers.index', [
            'Pathao' => optional($settingRepo->first('Pathao')->value),
            'SteadFast' => optional($settingRepo->first('SteadFast')->value),
        ]);
    }

    public function store(Request $request, SettingRepository $settingRepo)
    {
        $settingRepo->setMany($request->only(['Pathao', 'SteadFast']));

        return redirect()->back()->with('success', 'Couriers updated successfully.');
    }
}
