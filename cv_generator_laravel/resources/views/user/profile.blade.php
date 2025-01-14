@extends('templates.master_user')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
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
                                                <textarea name="about_me" class="form-control @error('about_me') is-invalid @enderror" id="about_me"
                                                    style="height: 100px" placeholder="Insert about yourself, max:1000 characters">{{ old('about_me', $detail_user->about_me) }}</textarea>
                                            </div>
                                            @error('about_me')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- role --}}
                                        <div class="row mb-3">
                                            <label for="role" class="col-md-4 col-lg-3 col-form-label">Your
                                                Role</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text"
                                                    class="form-control @error('role') is-invalid @enderror"
                                                    name="role" required maxlength="255"
                                                    placeholder="ex: Full Stack Developer"
                                                    value="{{ old('role', $detail_user->role) }}">
                                            </div>
                                            @error('role')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- abilities --}}
                                        <div class="row mb-3">
                                            <label for="abilities" class="col-md-4 col-lg-3 col-form-label">Abilities,
                                                max:3</label>

                                            {{-- abilitites --}}
                                            <div class="col-md-8 col-lg-9">
                                                {{-- abilities_1 --}}
                                                <input type="text"
                                                    class="form-control mb-2 @error('abilities_1') is-invalid @enderror"
                                                    name="abilities_1" maxlength="100"
                                                    placeholder="ex: Developer or Web Developer"
                                                    value="{{ old('abilities_1') }}" required disabled>
                                                @error('abilities_1')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror

                                                {{-- abilities_2 --}}
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">
                                                        <input type="checkbox" id="check_abilities_2"
                                                            onload="abilities2Manage();" onchange="abilitites2Manage();"
                                                            @if (old('abilities_2')) checked @endif>
                                                    </span>
                                                    <input name="abilities_2" id="input_abilities_2"
                                                        @if (!old('abilities_2')) disabled @endif type="text"
                                                        class="form-control @error('abilities_2') is-invalid @enderror"
                                                        maxlength="100" value="{{ old('abilities_2') }}"
                                                        placeholder="More Abilities (optional) ">
                                                </div>
                                                @error('abilities_2')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror

                                                {{-- abilities_3 --}}
                                                <div class="input-group" id="abt3"
                                                    @if (!old('abilities_2')) hidden @endif>
                                                    <span class="input-group-text">
                                                        <input type="checkbox" id="check_abilities_3"
                                                            name="check_abilities_3" onchange="abilitites3Manage();"
                                                            @if (old('abilities_3')) checked @endif>
                                                    </span>
                                                    <input name="abilities_3" id="input_abilities_3"
                                                        @if (!old('abilities_3')) disabled @endif type="text"
                                                        value="{{ old('abilities_3') }}"
                                                        class="form-control @error('abilities_3') is-invalid @enderror"
                                                        maxlength="100" placeholder="More Abilities (optional)">
                                                </div>
                                                @error('abilities_3')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror


                                            </div>

                                        </div>
                                        {{-- end abilitites --}}

                                        {{-- address --}}
                                        <div class="row mb-3">
                                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="address" value="{{ old('address', $detail_user->address) }}"
                                                    placeholder="Insert your full address, max:700 characters">
                                                @error('address')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- phone number --}}
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone
                                                Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    id="Phone" value="{{ old('phone', $detail_user->phone) }}"
                                                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    type = "number" maxlength="20"
                                                    placeholder="081... Your phone number must be active whatsapp">
                                                @error('phone')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- instagram profile --}}
                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group mb-2">
                                                    {{-- checkbox instagram --}}
                                                    <span class="input-group-text">
                                                        <input type="checkbox" id="cb_instagram"
                                                            onchange="instagramUrlManage();"
                                                            @if (old('instagram_url', $detail_user->instagram_url)) checked @endif>
                                                    </span>

                                                    {{-- input text instagram --}}
                                                    <input name="instagram_url" type="text" id="input_instagram_url"
                                                        @if (!old('instagram_url', $detail_user->instagram_url)) disabled @endif
                                                        class="form-control @error('instagram_url') is-invalid @enderror"
                                                        maxlength="255"
                                                        value="{{ old('instagram_url', $detail_user->instagram_url) }}"
                                                        placeholder="https://www.instagram.com/#">
                                                    @error('instagram_url')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- facebook profile --}}
                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group mb-2">
                                                    {{-- checkbox facebook url --}}
                                                    <span class="input-group-text">
                                                        <input type="checkbox" id="cb_facebook"
                                                            onchange="facebookUrlManage();"
                                                            @if (old('facebook_url', $detail_user->facebook_url)) checked @endif>
                                                    </span>

                                                    {{-- input text facebook url --}}
                                                    <input name="facebook_url" type="text" id="input_facebook_url"
                                                        @if (!old('facebook_url', $detail_user->facebook_url)) disabled @endif
                                                        class="form-control @error('facebook_url') is-invalid @enderror"
                                                        maxlength="255"
                                                        value="{{ old('facebook_url', $detail_user->facebook_url) }}"
                                                        placeholder="https://www.facebook.com/#">
                                                    @error('facebook_url')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        {{-- twitter profile --}}
                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group mb-2">
                                                    {{-- chechbox twitter --}}
                                                    <span class="input-group-text">
                                                        <input type="checkbox" id="cb_twitter"
                                                            onchange="twitterUrlManage();"
                                                            @if (old('twitter_url', $detail_user->twitter_url)) checked @endif>
                                                    </span>
                                                    {{-- input twitter --}}
                                                    <input name="twitter_url" type="text" id="input_twitter_url"
                                                        @if (!old('twitter_url', $detail_user->twitter_url)) disabled @endif
                                                        class="form-control @error('twitter_url') is-invalid @enderror"
                                                        maxlength="255"
                                                        value="{{ old('twitter_url', $detail_user->twitter_url) }}"
                                                        placeholder="https://www.twitter.com/# OR https://www.x.com/#">
                                                    @error('twitter_url')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- linkedin profile --}}
                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="input-group mb-2">
                                                    {{-- checkbox linkedin --}}
                                                    <span class="input-group-text">
                                                        <input type="checkbox" id="cb_linkedin"
                                                            onchange="linkedinUrlManage();"
                                                            @if (old('linkedin_url', $detail_user->linked_in_url)) checked @endif>
                                                    </span>
                                                    {{-- input linkedin --}}
                                                    <input name="linkedin_url" type="text" id="input_linkedin_url"
                                                        @if (!old('linkedin_url', $detail_user->linked_in_url)) disabled @endif
                                                        class="form-control @error('linkedin_url') is-invalid @enderror"
                                                        maxlength="255"
                                                        value="{{ old('linkedin_url', $detail_user->linked_in_url) }}"
                                                        placeholder="https://www.linkedin.com/in/#">
                                                    @error('linkedin_url')
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    @enderror
                                                </div>
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

    <script>
        function abilitites2Manage() {
            var checkbox = document.getElementById('check_abilities_2');
            var abilitiesInput = document.getElementById('input_abilities_2');

            var checkboxAbilities3 = document.getElementById('check_abilities_3')
            var abilities3 = document.getElementById('abt3');

            checkboxAbilities3.checked = false;
            abilitites3Manage();
            if (checkbox.checked) {
                // alert("checked");
                abilitiesInput.required = true
                abilitiesInput.disabled = false; // Mengaktifkan input text
                abilities3.hidden = false;
            } else {
                // alert("unchecked");
                abilitiesInput.value = "";
                abilitiesInput.required = false
                abilitiesInput.disabled = true; // Menonaktifkan input text
                abilities3.hidden = true;
            }
        }

        function abilitites3Manage() {
            var checkbox = document.getElementById('check_abilities_3');
            var abilitiesInput = document.getElementById('input_abilities_3');

            if (checkbox.checked) {
                // alert("checked");
                abilitiesInput.required = true
                abilitiesInput.disabled = false; // Mengaktifkan input text
            } else {
                // alert("unchecked");
                abilitiesInput.value = "";
                abilitiesInput.required = false
                abilitiesInput.disabled = true; // Menonaktifkan input text

            }
        }

        function instagramUrlManage() {
            var checkbox = document.getElementById('cb_instagram');
            var input = document.getElementById('input_instagram_url');

            if (checkbox.checked) {
                // alert("checked");
                input.required = true
                input.disabled = false; // Mengaktifkan input text
            } else {
                // alert("unchecked");
                input.value = "";
                input.required = false
                input.disabled = true; // Menonaktifkan input text

            }
        }

        function facebookUrlManage() {
            var checkbox = document.getElementById('cb_facebook');
            var input = document.getElementById('input_facebook_url');

            if (checkbox.checked) {
                // alert("checked");
                input.required = true
                input.disabled = false; // Mengaktifkan input text
            } else {
                // alert("unchecked");
                input.value = "";
                input.required = false
                input.disabled = true; // Menonaktifkan input text

            }
        }

        function twitterUrlManage() {
            var checkbox = document.getElementById('cb_twitter');
            var input = document.getElementById('input_twitter_url');

            if (checkbox.checked) {
                // alert("checked");
                input.required = true
                input.disabled = false; // Mengaktifkan input text
            } else {
                // alert("unchecked");
                input.value = "";
                input.required = false
                input.disabled = true; // Menonaktifkan input text

            }
        }

        function linkedinUrlManage() {
            var checkbox = document.getElementById('cb_linkedin');
            var input = document.getElementById('input_linkedin_url');

            if (checkbox.checked) {
                // alert("checked");
                input.required = true
                input.disabled = false; // Mengaktifkan input text
            } else {
                // alert("unchecked");
                input.value = "";
                input.required = false
                input.disabled = true; // Menonaktifkan input text

            }
        }
    </script>
@endsection
