<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Entities\Catalog\Machine;
use App\Entities\Catalog\Property;
use App\Entities\Catalog\Tag;
use App\Handlers\FileManager;
use App\Handlers\TransactionManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Catalog\Machines\CreateRequest;
use App\Http\Requests\Admin\Catalog\Machines\UpdateRequest;
use App\Repositories\MachineRepository;
use App\UseCases\Catalog\CreateMachine;
use App\UseCases\Catalog\UpdateMachine;
use App\Entities\Common\Gallery;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    public function index(MachineRepository $machineRepository)
    {
        $machines = $machineRepository->all();
        return view('admin.machines.index', compact('machines'));
    }

    public function create()
    {
        $tags = Tag::all();
        $properties = Property::all();
        $galleries = Gallery::all();
        $types = Machine::getTypes();
        return view('admin.machines.create', compact('tags', 'properties', 'galleries', 'types'));
    }

    public function store(CreateRequest $request, CreateMachine $createMachine, TransactionManager $transactionManager)
    {
        $dto = $request->getDto();
        $result = $transactionManager->handle(function () use ($dto, $createMachine) {
            return $createMachine->action($dto);
        });

        if ($result) {
            return redirect()->route('user.catalog.show', ['machine' => $result->slug]);
        }

        return redirect()->route('admin.machines.index')->with('error', 'При сохранении произошла ошибка.');
    }

    public function edit(string $slug, MachineRepository $repository)
    {
        $machine = $repository->findBySlug($slug);
        $tags = Tag::all();
        $properties = Property::all();
        $galleries = Gallery::all();
        $types = Machine::getTypes();
        return view('admin.machines.edit', compact('machine', 'tags', 'properties', 'galleries', 'types'));
    }

    public function update(UpdateRequest $request, Machine $machine, UpdateMachine $updateMachine, TransactionManager $transactionManager)
    {
        $dto = $request->getDto();

        $result = $transactionManager->handle(function () use ($dto, $updateMachine, $machine) {
            return $updateMachine->action($machine, $dto);
        });

        if ($result) {
            return redirect()->route('user.catalog.show', ['machine' => $machine->slug]);
        }

        return redirect()->route('admin.machines.index')->with('error', 'При сохранении произошла ошибка.');
    }

    public function destroy(Machine $machine, FileManager $manager)
    {
        $manager->delete([$machine->img]);
        $manager->delete($machine->images);
        $machine->delete();
        return redirect()->route('admin.machines.index');
    }

    public function pdf(Machine $machine)
    {
        return response()->download(storage_path('app/' . $machine->pdf));
    }
}
