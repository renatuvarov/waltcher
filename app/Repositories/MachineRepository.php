<?php

namespace App\Repositories;

use App\Entities\Catalog\Machine;

class MachineRepository
{
    public function all()
    {
        return Machine::paginate();
    }

    public function findById(int $id)
    {
        return Machine::findOrFail($id);
    }

    public function findBySlug(string $slug)
    {
        return Machine::whereSlug($slug)->first();
    }

    public function allWithTags(string $type = '')
    {
        return Machine::with('tags')->getMachines($type)->paginate();
    }

    public function findWithAllRelations(string $machine)
    {
        return Machine::where('slug', $machine)->with('tags', 'properties', 'gallery')->first();
    }
}
