<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
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
        if (empty($this->viewPath)) {
            $str = Str::beforeLast(Str::after(\get_called_class(), __NAMESPACE__ . '\\'), 'Controller');
            $dir = array_map(function ($item) {
                return Str::kebab($item);
            }, explode('\\', $str));
            $dir[] = Str::plural(array_pop($dir));
            $this->viewPath = implode('.', $dir);
        }

        empty($view) && (
            $view = debug_backtrace()[1]['function']
        );

        return view("{$this->viewPath}.{$view}", $data, $mergeData);
    }

    protected function delete()
    {
        $route = request()->route();
        $App = App::getNamespace();

        # Model Name & Key Name
        $Name = Str::beforeLast(Str::afterLast(\get_called_class(), '\\'), 'Controller');
        $keyName = Str::lower($Name);

        # Class & Object
        $class = class_exists($App.'Models\\'.$Name) ? $App.'Models\\'.$Name : $App.$Name;
        $object = new $class;

        # Model Binder
        $ModelBinder = data_get(
            $route->bindingFields(),
            $keyName,
            $object->getRouteKeyName()
        );

        # The Model
        $model = data_get($route->parameters(), $keyName);
        if (! $model instanceof Model) {
            $model = $class::where($ModelBinder, $model)->firstOrFail();
        }

        # Deleting The Model
        $model->delete();
        return back()->withSuccess("{$Name} Has Been Deleted.");
    }
}
