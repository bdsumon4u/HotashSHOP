<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPath = '';

    protected function view($data = [], $view = '', $mergeData = [])
    {
        $str = Str::beforeLast(Str::after(\get_called_class(), __NAMESPACE__ . '\\'), 'Controller');
        $dir = array_map(function ($item) {
            return Str::kebab($item);
        }, explode('\\', $str));
        $dir[] = Str::plural(array_pop($dir));
        $this->viewPath = implode('.', $dir);

        empty($view) && (
            $view = debug_backtrace()[1]['function']
        );

        return view("{$this->viewPath}.{$view}", $data, $mergeData);
    }
}
