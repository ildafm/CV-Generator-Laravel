@extends('templates.master_user')

@section('content')
    <div class="pagetitle">
        <h1>My Services</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/services">My Services</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Updating your service about {{ $serviceUser->service_name }}</h5>

            {{-- session message --}}
            @if (session()->has('pesan_error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('pesan_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- General Form Elements -->
            <form action="{{ route('services.update', ['service' => $serviceUser->id]) }}" method="POST"
                onsubmit="document.getElementById('btn_submit').disabled = true">
                @method('PUT')
                @csrf

                <div class="form-group mb-2">
                    <label class="form-label" for="service_name">Service Name</label>
                    <input name="service_name" type="text"
                        class="form-control @error('service_name') is-invalid @enderror"
                        placeholder="ex: Web Developer OR Android Developer|max:50 characters" maxlength="50"
                        value="{{ old('service_name', $serviceUser->service_name) }}" required>
                    @error('service_name')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="service_detail" class="form-label">Detail of Your Service</label>
                    <textarea name="service_detail" id="" style="height: 100%" placeholder="max:200 characters" maxlength="200"
                        required class="form-control @error('service_detail') is-invalid @enderror" onkeyup="count_up(this);">{{ old('service_detail', $serviceUser->service_detail) }}</textarea>
                    <span class="text-muted pull-right" id="count1">Character count:
                        0/200</span>
                    @error('service_detail')
                        <div class="small text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
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
