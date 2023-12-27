@extends('templates.master_user')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                {{-- <li class="breadcrumb-item">Users</li> --}}
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            {{-- left --}}
            <div class="col-xl-4">

                <div class="card">

                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('user_page_template/img/profile-img.jpg') }}" alt="Profile"
                            class="rounded-circle">
                        {{-- Full Name --}}
                        <h2>{{ $user->name }}</h2>
                        {{-- package account --}}
                        <h3>
                            @php
                                switch ($user->package) {
                                    case 'P':
                                        echo 'Premium Account';
                                        break;
                                    case 'F':
                                        echo 'Free Account';
                                        break;
                                    default:
                                        echo 'Kesalahan sistem';
                                        break;
                                }
                            @endphp
                        </h3>
                        {{-- medsos list --}}
                        <div class="social-links mt-2">
                            @if (isset($detail_user->twitter_url))
                                <a href="{{ $detail_user->twitter_url }}" class="twitter"><i class="bi bi-twitter"></i></a>
                            @endif

                            @if (isset($detail_user->facebook_url))
                                <a href="{{ $detail_user->facebook_url }}" class="facebook"><i
                                        class="bi bi-facebook"></i></a>
                            @endif

                            @if (isset($detail_user->instagram_url))
                                <a href="{{ $detail_user->instagram_url }}" class="instagram"><i
                                        class="bi bi-instagram"></i></a>
                            @endif

                            @if (isset($detail_user->linke_id_url))
                                <a href="{{ $detail_user->linke_id_url }}" class="linkeid"><i class="bi bi-linkeid"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- right --}}
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change
                                    Password</button>
                            </li>

                            {{-- <li class="nav-item">
                                <button class="nav-link text-danger" data-bs-toggle="tab"
                                    data-bs-target="#danger-zone">Danger
                                    Zone</button>
                            </li> --}}

                        </ul>

                        {{-- tab content --}}
                        <div class="tab-content pt-2">

                            {{-- overview tab --}}
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                {{-- pesan success ubah data --}}
                                @if (session()->has('pesan_success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{-- <i class="bi bi-check-circle me-1"></i> --}}
                                        {{ session()->get('pesan_success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif(session()->has('pesan_error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{-- <i class="bi bi-check-circle me-1"></i> --}}
                                        {{ session()->get('pesan_error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                {{-- jika ada detail user, maka tampilkan about me --}}
                                @if (isset($detail_user))
                                    <h5 class="card-title">About Me</h5>
                                    <p class="small">
                                        {{ $detail_user->about_me }}
                                    </p>
                                @endif

                                <h5 class="card-title">Profile Details</h5>

                                {{-- full name --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                {{-- address --}}
                                @if (isset($detail_user))
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $detail_user->address }}
                                        </div>
                                    </div>
                                @endif


                                {{-- phone --}}
                                @if (isset($detail_user))
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $detail_user->phone }}
                                        </div>
                                    </div>
                                @endif

                                {{-- email --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                            </div>

                            {{-- profile edit form --}}
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}"
                                    onsubmit="document.getElementById('btn_submit_basic_update').disabled = true;">
                                    @method('PUT')
                                    @csrf

                                    {{-- profile image --}}
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="{{ asset('user_page_template/img/profile-img.jpg') }}"
                                                alt="Profile">
                                            <div class="pt-2">
                                                <a href="#" class="btn btn-primary btn-sm"
                                                    title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm"
                                                    title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                value="{{ old('name', $user->name) }}" required
                                                placeholder="Insert your full name, max:255 characters" maxlength="255">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    @if (isset($detail_user))
                                        {{-- about me --}}
                                        <div class="row mb-3">
                                            <label for="about_me" class="col-md-4 col-lg-3 col-form-label">About
                                                Me</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about_me" class="form-control" id="about_me" style="height: 100px"
                                                    placeholder="Insert about yourself, max:1000 characters">{{ old('about_me', $detail_user->about_me) }}</textarea>
                                            </div>
                                        </div>

                                        {{-- address --}}
                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="address"
                                                    value="{{ old('address', $detail_user->address) }}"
                                                    placeholder="Insert your full address, max:700 characters">
                                            </div>
                                        </div>

                                        {{-- phone number --}}
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    value="{{ old('phone', $detail_user->phone) }}"
                                                    placeholder="Insert your active whatsapp phone number. ex: 081...">
                                            </div>
                                        </div>
                                        {{-- instagram profile --}}
                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control"
                                                    id="Instagram"
                                                    value="{{ old('instagram', $detail_user->instagram_url) }}"
                                                    placeholder="https://instagram.com/#">
                                            </div>
                                        </div>

                                        {{-- facebook profile --}}
                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control"
                                                    id="Facebook"
                                                    value="{{ old('facebook', $detail_user->facebook_url) }}"
                                                    placeholder="https://facebook.com/#">
                                            </div>
                                        </div>


                                        {{-- twitter profile --}}
                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter"
                                                    value="{{ old('twitter', $detail_user->twitter_url) }}"
                                                    placeholder="https://www.twitter.com/# OR https://www.x.com/#">
                                            </div>
                                        </div>

                                        {{-- linkedin profile --}}
                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin" type="text" class="form-control"
                                                    id="Linkedin"
                                                    value="{{ old('linkedin', $detail_user->linked_in_url) }}"
                                                    placeholder="https://www.linkedin.com/in/#">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="text-center">
                                        <button id="btn_submit_basic_update" type="submit" class="btn btn-primary">Save
                                            Changes</button>
                                    </div>
                                </form>
                                <!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
