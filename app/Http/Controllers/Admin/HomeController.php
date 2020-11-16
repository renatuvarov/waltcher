<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Catalog\Machine;
use App\Entities\Catalog\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $ordersCount = DB::table('orders')->count();
        $activeOrdersCount = DB::table('orders')->where('viewed', false)->count();
        $machines = Machine::all(['id', 'name']);

        $startDate = $request->query('start_date')
            ? Carbon::createFromFormat('d.m.Y', $request->query('start_date'))->startOfDay()
            : Order::query()->orderBy('id')->first()->created_at;

        $endDate = $request->query('end_date')
            ? Carbon::createFromFormat('d.m.Y', $request->query('end_date'))
            : Carbon::now();

        $query = Order::query()
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        $selectedMachine = null;

        if ($request->query('machine_id')) {
            $query->where('machine_id', $request->query('machine_id'));
            $selectedMachine = $machines->where('id', $request->query('machine_id'))->first()->name;
        }

        $count = $query->count();

        return view('admin.home', compact(
                'ordersCount',
                'activeOrdersCount',
                'machines',
                'count',
                'selectedMachine',
                'startDate',
                'endDate'
            )
        );
    }
}
