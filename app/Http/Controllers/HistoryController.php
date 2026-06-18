<?php

namespace App\Http\Controllers;

use App\Models\AudioProcess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = AudioProcess::where(
            'user_id',
            Auth::id()
        )
        ->where('status', 'completed');

        if ($request->filled('search')) {

            $query->where(
                'original_file',
                'like',
                '%' . $request->search . '%'
            );
        }

        $histories = $query
            ->latest()
            ->get();

        return view(
            'history.index',
            compact('histories')
        );
    }

    public function edit($id)
    {
        return redirect(
            '/dashboard?history=' . $id
        );
    }

    public function destroy($id)
    {
        $audio = AudioProcess::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        if ($audio->processed_file) {

            Storage::disk('public')->delete(
                $audio->processed_file
            );

        }

        $audio->delete();

        return back()->with(
            'success',
            'History berhasil dihapus'
        );
    }
}
