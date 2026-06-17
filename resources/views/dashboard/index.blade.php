<x-app-layout>
    
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

@if(session('success'))
<div class="alert alert-success m-3">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger m-3">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="dashboard-page">

    <div class="container">

        <div class="text-center mb-5">

            <h1 class="page-title">
                Audio Processing
            </h1>

            <p class="page-subtitle">
                AI Audio Enhancement & Noise Reduction
            </p>

        </div>

        {{-- LOADING --}}
        @if($latestFile && $latestFile->status === 'processing')

            <div class="card shadow border-0">

                <div class="card-body text-center py-5">

                    <div
                        class="spinner-border text-primary mb-4"
                        style="width:5rem;height:5rem;">

                    </div>

                    <h3>
                        Processing Your File...
                    </h3>

                    <p class="text-muted">
                        Please wait and do not close this page
                    </p>

                </div>

            </div>

        @else

            <div class="processing-card">

                {{-- PREVIEW --}}
                <div class="preview-section">

                    @if($latestFile)

                        @if(!$latestFile->processed_file)

                            <div class="preview-badge">
                                Before Processing
                            </div>

                            <div class="preview-box">

                                @if($latestFile->file_type === 'audio')

                                    <audio controls class="w-100 custom-player">
                                        <source src="{{ asset('storage/' . $latestFile->original_file) }}">
                                    </audio>

                                @else

                                    <video controls width="100%" class="rounded-4">
                                        <source src="{{ asset('storage/' . $latestFile->original_file) }}">
                                    </video>

                                @endif

                            </div>

                        @else

                            <div class="row g-4">

                                <div class="col-md-6">

                                    <div class="preview-badge">
                                        Before
                                    </div>

                                    <div class="preview-box">

                                        @if($latestFile->file_type === 'audio')

                                            <audio controls class="w-100 custom-player">
                                                <source src="{{ asset('storage/' . $latestFile->original_file) }}">
                                            </audio>

                                        @else

                                            <video controls width="100%" class="rounded-4">
                                                <source src="{{ asset('storage/' . $latestFile->original_file) }}">
                                            </video>

                                        @endif

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="preview-badge">
                                        After
                                    </div>

                                    <div class="preview-box">

                                        @if($latestFile->file_type === 'audio')

                                            <audio controls class="w-100 custom-player">
                                                <source src="{{ asset('storage/' . $latestFile->processed_file) }}">
                                            </audio>

                                        @else

                                            <video controls width="100%" class="rounded-4">
                                                <source src="{{ asset('storage/' . $latestFile->processed_file) }}">
                                            </video>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @endif

                    @else

                        <div class="preview-box empty-preview">

                            <h5>No File Uploaded Yet</h5>

                        </div>

                    @endif

                </div>

                {{-- UPLOAD --}}
                <div class="upload-section">

                    <form
                        action="{{ route('audio.upload') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input
                            type="file"
                            name="audio_file"
                            class="form-control custom-upload">

                        <small class="text-muted">
                            MP3, WAV, MP4 (Max 50 MB)
                        </small>

                        <button
                            class="btn upload-btn w-100 mt-3">

                            Upload File

                        </button>

                    </form>

                </div>

                {{-- SETTINGS --}}
                @if($latestFile)

                    <div class="settings-section">

                        <form
                            action="{{ route('audio.process', $latestFile->id) }}"
                            method="POST">

                            @csrf

                            <div class="slider-header">
                                <span>Noise Reduction</span>
                                <span>{{ $latestFile->noise_reduction }}%</span>
                            </div>

                            <input
                                type="range"
                                class="form-range modern-slider"
                                name="noise_reduction"
                                min="0"
                                max="100"
                                value="{{ $latestFile->noise_reduction }}">

                            <div class="slider-header mt-4">
                                <span>Audio Enhancement</span>
                                <span>{{ $latestFile->audio_enhancement }}%</span>
                            </div>

                            <input
                                type="range"
                                class="form-range modern-slider"
                                name="audio_enhancement"
                                min="0"
                                max="100"
                                value="{{ $latestFile->audio_enhancement }}">

                            <button
                                class="btn process-btn w-100 mt-4">

                                Process

                            </button>

                        </form>

                        @if($latestFile->processed_file)

                            <a
                                href="{{ route('audio.download', $latestFile->id) }}"
                                class="btn download-btn w-100 mt-3">

                                Download Result

                            </a>

                            <form
                                action="{{ route('audio.reprocess', $latestFile->id) }}"
                                method="POST">

                                @csrf

                                <button
                                    class="btn reprocess-btn w-100 mt-3">

                                    Reprocess

                                </button>

                            </form>

                        @endif

                    </div>

                @endif

            </div>

        @endif

    </div>

</div>

</x-app-layout>