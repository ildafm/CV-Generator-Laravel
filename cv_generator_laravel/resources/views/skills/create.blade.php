@extends('templates.master_user')

@section('content')
    <style>
        .custom_range {
            -webkit-appearance: none;
            width: 100%;
            height: 7px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .custom_range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #0275d8;
            cursor: pointer;
        }

        .custom_range::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #0275d8;
            cursor: pointer;
        }
    </style>

    <div class="pagetitle">
        <h1>Skills</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/skills">Skill</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Adding a new skill</h5>

            {{-- session message --}}
            @if (session()->has('pesan_error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('pesan_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- General Form Elements -->
            <form action="{{ route('skills.store') }}" method="POST"
                onsubmit="document.getElementById('btn_submit').disabled = true">
                @csrf

                <div class="form-group mb-2">
                    <label class="form-label" for="skill_name">Skill Name</label>
                    <input name="skill_name" type="text" class="form-control @error('skill_name') is-invalid @enderror"
                        placeholder="ex: HTML OR CSS OR JavaScript|max:20 characters" maxlength="20"
                        value="{{ old('skill_name') }}" required>
                    @error('skill_name')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="skill_confident" class="form-label">How confident are you in your skills?</label>
                    <div style="display: flex; align-items: center;">
                        <input name="skill_confident" type="range" class="custom_range" min="1" max="100"
                            step="1" value="10" id="skill_confident">
                        <output for="skill_confident" id="output_skill_confident">10</output>
                    </div>
                    @error('skill_confident')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button id="btn_submit" type="submit" class="btn btn-primary">Save</button>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap elemen slider
            var slider = document.getElementById('skill_confident');

            // Tangkap elemen output
            var output = document.getElementById('output_skill_confident');

            // Tambahkan event listener untuk menanggapi perubahan nilai slider
            slider.addEventListener('input', function() {
                // Perbarui nilai output
                output.value = this.value;
            });
        });
    </script>
@endsection
