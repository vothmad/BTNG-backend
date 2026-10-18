<?php

namespace App\Http\Controllers;

use App\Models\Soul;
use Illuminate\Http\Request;

class SoulController extends Controller
{
    public function store(Request $request)
    {
        $soul = Soul::create([
            'victim' => $request->victim,
            'reaper' => $request->reaper,
            'power' => $request->power,
            'soul_perished' => $request->soul_perished ?? false
        ]);

        return response()->json(['message' => 'Soul harvested delightfully!', 'data' => SoulsResource($soul)], 201);
    }

    public function killCount()
    {
        $leaderboard = Soul::select('reaper')
            ->selectRaw('count(*) as total_souls_taken')
            ->selectRaw('sum(case when soul_perished = 1 then 1 else 0 end) as total_perished_kills')
            ->groupBy('reaper') 
            ->orderBy('total_perished_kills', 'desc')
            ->get();
            
        return response()->json([
            'message' => 'Grim Reaper Gloryboard Fetched!',
            'leaderboard' => $leaderboard
        ]);
    }

    public function update(Request $request, Soul $soul)
    {
        $validated = $request->validate([
            'victim' => 'required|string|max:255',
            'reaper' => 'required|string|max:255',
            'power' => 'required|numeric',
            'soul_perished' => 'required|boolean',
        ]);

        $soul->update($validated);

        return response()->json([$soul], 200);
    }


    public function destroy(Soul $soul)
    {
        $soul->delete();

        return response()->json([
            'message' => 'Soul banished to the void!'
        ], 200);
    }
}
