<?php

namespace App\Http\Controllers\User\Catalog;

use App\Entities\Catalog\Machine;
use App\Http\Controllers\Controller;
use App\Repositories\MachineRepository;

class MachineController extends Controller
{
    /**
     * @var MachineRepository
     */
    private $machineRepository;

    public function __construct(MachineRepository $machineRepository)
    {
        $this->machineRepository = $machineRepository;
    }

    public function index(string $type = '')
    {
        $machines = $this->machineRepository->allWithTags($type);
        return view('user.catalog.machines.index', compact('machines'));
    }

    public function show(string $machine)
    {
        $machine = $this->machineRepository->findWithAllRelations($machine);
        $fragment = 'user.catalog.machines.';
        $view = $machine->is_landing ? $fragment . $machine->slug : $fragment . 'show';

        return view($view, [
            'machine' => $machine,
        ]);
    }
}
