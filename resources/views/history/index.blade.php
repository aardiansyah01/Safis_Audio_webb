<x-app-layout>

<link rel="stylesheet" href="{{ asset('css/history.css') }}">

<div class="history-page">

    <div class="container">

        <div class="text-center mb-5">

            <h1 class="history-title">
                History of My Project
            </h1>

            <p class="history-subtitle">
                Your processed audio and video files
            </p>

        </div>

        <form
            method="GET"
            action="{{ route('history') }}"
            class="mb-5">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"

                    placeholder="Search project name...">

                <button
                    class="btn btn-primary">

                    Search

                </button>

            </div>

        </form>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @forelse($histories as $history)

            <div class="history-card">

                <div class="history-left">

                    <div class="history-icon">

                        🎵

                    </div>

                    <div>

                        <h5 class="mb-1">

                            {{ basename($history->original_file) }}

                        </h5>

                        <small class="text-muted">

                            {{ $history->created_at->format('d M Y H:i') }}

                        </small>

                        <br>

                        <small class="text-muted">

                            Noise:
                            {{ $history->noise_reduction }}%

                            |

                            Enhancement:
                            {{ $history->audio_enhancement }}%

                        </small>

                    </div>

                </div>

                <div class="history-actions">

                    <a
                        href="{{ route('history.edit', $history->id) }}"
                        class="btn btn-dark">

                        Edit

                    </a>

                    <form
                        action="{{ route('history.delete', $history->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="button"
                            class="btn btn-outline-danger delete-history-btn"

                            data-url="{{ route('history.delete', $history->id) }}">

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty-history">

                No processed files found.

            </div>

        @endforelse

    </div>

</div>

<!-- DELETE MODAL -->

<div
    class="modal fade"
    id="deleteHistoryModal"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header">

                <h5 class="modal-title">

                    Delete History Project

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <p class="mb-2">

                    Are you sure you want to delete this history project?

                </p>

                <small class="text-danger">

                    This action cannot be undone.

                </small>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <form
                    id="deleteHistoryForm"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const deleteButtons =
                document.querySelectorAll(
                    '.delete-history-btn'
                );

            const deleteForm =
                document.getElementById(
                    'deleteHistoryForm'
                );

            deleteButtons.forEach(button => {

                button.addEventListener(
                    'click',
                    function () {

                        deleteForm.action =
                            this.dataset.url;

                        const modal =
                            new bootstrap.Modal(
                                document.getElementById(
                                    'deleteHistoryModal'
                                )
                            );

                        modal.show();

                    }
                );

            });

        }
    );

</script>

</x-app-layout>