@extends('templates.master_user')

@section('content')
    <div class="pagetitle">
        <h1>My Projects</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/projects">My Project</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Updating your project data about {{ $project->project_name }}</h5>

            {{-- session message --}}
            @if (session()->has('pesan_error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('pesan_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- General Form Elements -->
            <form action="{{ route('projects.update', ['project' => $project->id]) }}" method="POST"
                onsubmit="document.getElementById('btn_submit').disabled = true">
                @method('PUT')
                @csrf

                <div class="form-group mb-2">
                    <label class="form-label" for="project_name">Project Name</label>
                    <input name="project_name" type="text"
                        class="form-control @error('project_name') is-invalid @enderror"
                        placeholder="Name of your project|max:100 characters" maxlength="100"
                        value="{{ old('project_name', $project->project_name) }}" required>
                    @error('project_name')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label" for="project_category">Project Category</label>
                            <input name="project_category" type="text"
                                class="form-control @error('project_category') is-invalid @enderror"
                                placeholder="ex: Web Design OR Android Application|max:20 characters" maxlength="20"
                                value="{{ old('project_category', $project->project_category) }}" required>
                            @error('project_category')
                                <div class="small text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label" for="project_created_date">Project Created Date (<i
                                    class="small">When did you start creating this project</i>)
                            </label>
                            <input id="input_tgl" name="project_created_date"
                                class="form-control @error('project_created_date') is-invalid @enderror" type="date"
                                value="{{ old('project_created_date', $project->project_created_date) }}"
                                max="{{ now()->format('Y-m-d') }}">

                            @error('project_created_date')
                                <div class="small text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <button id="btn_submit" type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>

    <script>
        function count_up(obj) {
            document.getElementById('count1').innerHTML = "Character count: " + obj.value.length + "/200";
        }
    </script>
@endsection
