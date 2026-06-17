<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudioProcess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AudioProcessingController extends Controller
{
    public function index()
    {
        $latestFile = AudioProcess::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->first();

        return view(
            'dashboard.index',
            compact('latestFile')
        );
    }

    public function process(
        Request $request,
        $id
    )
    {
        $request->validate([
            'noise_reduction' => 'required|integer|min:0|max:100',
            'audio_enhancement' => 'required|integer|min:0|max:100',
        ]);

        $audio = AudioProcess::where(
            'user_id',
            Auth::id()
        )->findOrFail($id);

        $audio->update([
            'noise_reduction' => $request->noise_reduction,
            'audio_enhancement' => $request->audio_enhancement,
            'status' => 'processing'
        ]);

        try {

            $fullPath = storage_path(
                'app/public/' .
                $audio->original_file
            );

            $response = Http::timeout(300)
                ->attach(
                    'file',
                    fopen($fullPath, 'r'),
                    basename($fullPath)
                )
                ->post(
                    'http://127.0.0.1:8001/upload',
                    [
                        'noise_reduction' =>
                            $audio->noise_reduction,

                        'audio_enhancement' =>
                            $audio->audio_enhancement
                    ]
                );

            if (!$response->successful()) {

                $audio->update([
                    'status' => 'failed'
                ]);

                return back()->withErrors([
                    'Backend AI gagal memproses file.'
                ]);
            }

            $result = $response->json();

            $enhancedFile =
                $result['enhanced_file'];

            $downloadResponse =
                Http::timeout(300)
                ->get(
                    'http://127.0.0.1:8001/download/' .
                    $enhancedFile
                );

            if (!$downloadResponse->successful()) {

                $audio->update([
                    'status' => 'failed'
                ]);

                return back()->withErrors([
                    'Gagal mengambil file hasil dari FastAPI'
                ]);
            }

            Storage::disk('public')->put(
                'processed/' . $enhancedFile,
                $downloadResponse->body()
            );

            $audio->update([
                'processed_file' =>
                    'processed/' . $enhancedFile,

                'status' => 'completed'
            ]);

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Audio berhasil diproses'
                );

        } catch (\Exception $e) {

            $audio->update([
                'status' => 'failed'
            ]);

            return back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

    public function download($id)
    {
        $audio = AudioProcess::findOrFail($id);

        if (!$audio->processed_file) {
            abort(404);
        }

        return Storage::disk('public')
            ->download(
                $audio->processed_file
            );
    }

    public function reprocess($id)
    {
        $audio = AudioProcess::findOrFail($id);

        $audio->processed_file = null;

        $audio->status = 'uploaded';

        $audio->save();

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Silakan atur ulang parameter'
            );
    }

    public function upload(Request $request)
    {
        $request->validate([
            'audio_file' => [
                'required',
                'file',
                'mimes:mp3,wav,mp4',
                'max:51200'
            ],
        ]);

        $file = $request->file('audio_file');

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $fileType = in_array(
            $extension,
            ['mp4']
        )
            ? 'video'
            : 'audio';

        $filename =
            time() .
            '_' .
            $file->getClientOriginalName();

        $path = $file->storeAs(
            'uploads/original',
            $filename,
            'public'
        );

        AudioProcess::create([
            'user_id' => Auth::id(),

            'original_file' => $path,

            'file_type' => $fileType,

            'duration' => 0,

            'noise_reduction' => 50,

            'audio_enhancement' => 50,

            'status' => 'uploaded'
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'File berhasil diupload'
        );
    }
}
