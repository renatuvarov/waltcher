<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Common\Correction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Corrections\CreateRequest;
use App\Http\Requests\Admin\Corrections\UpdateRequest;
use Illuminate\Support\Facades\DB;

class CorrectionsController extends Controller
{
    public function index()
    {
        $correctionsCount = DB::table('corrections')->count();
        $correctionsActiveCount = DB::table('corrections')->where('active', true)->count();

        $corrections = Correction::query();

        if ( ! empty($active)) {
            $corrections->where('active', true);
        }

        $corrections = $corrections->orderByDesc('id')->paginate(config('site.user.pagination'));
        return view('admin.corrections.index', compact('corrections', 'correctionsCount', 'correctionsActiveCount'));
    }

    public function create(CreateRequest $request)
    {
        Correction::query()->create([
            'from' => $request->correction_from,
            'to' => $request->correction_to,
            'comment' => $request->correction_comment ?: null,
            'url' => $request->correction_url,
            'active' => true,
        ]);
    }

    public function edit(Correction $correction)
    {
        $correction->update([
            'active' => false,
        ]);

        return redirect()->route('admin.corrections.index');
    }

    public function update(UpdateRequest $request, Correction $correction)
    {
        $correction->update([
            'active' => false,
        ]);

        return redirect()->route('admin.corrections.index');
    }

    public function destroy(Correction $correction)
    {
        $correction->delete();
        return redirect()->route('admin.corrections.index');
    }
}
