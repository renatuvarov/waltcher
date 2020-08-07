<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Entities\Catalog\Property;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Catalog\Properties\CreateRequest;
use App\Http\Requests\Admin\Catalog\Properties\UpdateRequest;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::paginate();
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(CreateRequest $request)
    {
        Property::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.properties.index');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(UpdateRequest $request, Property $property)
    {
        $property->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.properties.index');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index');
    }
}
