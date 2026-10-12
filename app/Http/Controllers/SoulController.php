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

        return response()->json(['message' => 'Soul harvested delightfully!', 'data' => $soul], 201);
    }

    public function killcount()
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
}
