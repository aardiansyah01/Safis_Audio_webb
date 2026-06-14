<x-app-layout>

<div class="container py-5">

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header">
                    Preview Audio / Video
                </div>

                <div class="card-body">

                    <div
                        class="bg-light rounded d-flex justify-content-center align-items-center"
                        style="height:350px;">

                        Preview Area

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    Enhancement Settings
                </div>

                <div class="card-body">

                    <label>
                        Noise Reduction
                    </label>

                    <input
                        type="range"
                        class="form-range"
                        min="0"
                        max="100">

                    <label class="mt-3">
                        Audio Enhancement
                    </label>

                    <input
                        type="range"
                        class="form-range"
                        min="0"
                        max="100">

                    <button
                        class="btn btn-primary w-100 mt-4">

                        Process Audio

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>