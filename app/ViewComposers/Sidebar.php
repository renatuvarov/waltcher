<?php

namespace App\ViewComposers;

use App\Entities\Catalog\Machine;
use App\Entities\Catalog\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Sidebar
{
    public function compose(View $view)
    {
        $categories = $this->categories();
        $routeArray = $this->route(Machine::getTypes());

        return $view->with(compact('categories', 'routeArray'));
    }

    private function categories(): array
    {
        return Cache::rememberForever('categories', function() {
            $categories = DB::table('machine_tag')->select('tag_id')->distinct()->pluck('tag_id');
            return Tag::find($categories)->toArray();
        });
    }

    private function route(array $types): array
    {
        $routeArray = [];
        $route = request()->route();

        foreach ($types as $type) {
            $routeParams = $route->parameters;
            $routeParams['type'] = $type;

            $routeArray[$type] = [
                'params' => $routeParams,
                'name' => $route->getName(),
            ];
        }

        return $routeArray;
    }
}
