<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('description', 'LIKE', "%{$busca}%")
                  ->orWhere('subject_type', 'LIKE', "%{$busca}%")
                  ->orWhereHas('user', function ($q2) use ($busca) {
                      $q2->where('name', 'LIKE', "%{$busca}%");
                  });
            });
        }

        if ($request->filled('acao')) {
            $query->where('action', $request->acao);
        }

        $registos = $query->paginate(20)->withQueryString();

        // Marcar como vistas apenas as do utilizador atual
        ActivityLog::naoVistas()->where('user_id', Auth::id())->update(['read_at' => now()]);

        return view('activity-logs.index', compact('registos'));
    }
}
