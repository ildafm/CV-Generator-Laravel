@extends('templates.master_user')

@section('content')
    <div class="pagetitle">
        <h1>Create My Portfolio</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">My Portfolio</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ready to Create the Portfolio</h5>

                {{-- session message --}}
                @if (session()->has('pesan_error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session()->get('pesan_error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <i class="small mb-2">*Please complete the following data</i>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('portfolios.store') }}"
                    onsubmit="document.getElementById('btn_submit_form_create').disabled = true"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly disabled>
                        </div>
                    </div>

                    {{-- full name --}}
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Full
                            Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                disabled required maxlength="255" placeholder="Insert your full name, max 255 characters"
                                value="{{ old('name', $user->name) }}">
                        </div>
                        @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- phone number --}}
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                required
                                oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                type = "number" maxlength="20"
                                placeholder="081... Your phone number must be active whatsapp" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- address --}}
                    <div class="row mb-3">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                required maxlength="255"
                                placeholder="ex: Jl. Rajawali No.14, 9 Ilir, Kec. Ilir Tim. II, Kota Palembang, Sumatera Selatan 30113"
                                value="{{ old('address') }}">
                        </div>
                        @error('address')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- about me --}}
                    <div class="row mb-3">
                        <label for="about_me" class="col-sm-2 col-form-label">About Me</label>
                        <div class="col-sm-10">
                            <textarea name="about_me" id="" style="height: 100px"
                                class="form-control @error('about_me') is-invalid @enderror" maxlength="800"
                                placeholder="Tell us about yourself, max 800 characters" required onkeyup="count_up(this);">{{ old('about_me') }}</textarea>
                            <span class="text-muted pull-right" id="count1">Character count:
                                0/800</span>
                            @error('about_me')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- role --}}
                    <div class="row mb-3">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                                required maxlength="255" placeholder="ex: Full Stack Developer"
                                value="{{ old('role') }}">
                        </div>
                        @error('role')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- abilities --}}
                    <div class="row mb-3">
                        <label for="abilities" class="col-sm-2 col-form-label">Abilities, max:3</label>

                        {{-- abilitites --}}
                        <div class="col-sm-10">
                            {{-- abilities_1 --}}
                            <input type="text" class="form-control mb-2 @error('abilities_1') is-invalid @enderror"
                                name="abilities_1" maxlength="100" placeholder="ex: Developer or Web Developer"
                                value="{{ old('abilities_1') }}" required>
                            @error('abilities_1')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            {{-- abilities_2 --}}
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <input type="checkbox" id="check_abilities_2" onload="abilities2Manage();"
                                        onchange="abilitites2Manage();" @if (old('abilities_2')) checked @endif>
                                </span>
                                <input name="abilities_2" id="input_abilities_2"
                                    @if (!old('abilities_2')) disabled @endif type="text"
                                    class="form-control @error('abilities_2') is-invalid @enderror" maxlength="100"
                                    value="{{ old('abilities_2') }}" placeholder="More Abilities (optional) ">
                            </div>
                            @error('abilities_2')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            {{-- abilities_3 --}}
                            <div class="input-group" id="abt3" @if (!old('abilities_2')) hidden @endif>
                                <span class="input-group-text">
                                    <input type="checkbox" id="check_abilities_3" name="check_abilities_3"
                                        onchange="abilitites3Manage();" @if (old('abilities_3')) checked @endif>
                                </span>
                                <input name="abilities_3" id="input_abilities_3"
                                    @if (!old('abilities_3')) disabled @endif type="text"
                                    value="{{ old('abilities_3') }}"
                                    class="form-control @error('abilities_3') is-invalid @enderror" maxlength="100"
                                    placeholder="More Abilities (optional)">
                            </div>
                            @error('abilities_3')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror


                        </div>

                    </div>
                    {{-- end abilitites --}}

                    {{-- sosmed --}}
                    <div class="row mb-3">
                        <label for="sosmed" class="col-sm-2 col-form-label">Social Media <br><i
                                class="small">optional, you can fill in just one or all</i></label>
                        <div class="col-sm-10">
                            <div class="row">
                                {{-- instagram --}}
                                <div class="col-sm-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <input type="checkbox" id="cb_instagram" onchange="instagramUrlManage();"
                                                @if (old('instagram_url')) checked @endif>
                                        </span>
                                        <input name="instagram_url" type="text" id="input_instagram_url"
                                            @if (!old('instagram_url')) disabled @endif
                                            class="form-control @error('instagram_url') is-invalid @enderror"
                                            maxlength="255" value="{{ old('instagram_url') }}"
                                            placeholder="https://www.instagram.com/#">
                                        <div class="input-group-text"><i class="bi bi-instagram"></i></div>
                                        @error('instagram_url')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- facebook --}}
                                <div class="col-sm-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <input type="checkbox" id="cb_facebook" onchange="facebookUrlManage();"
                                                @if (old('facebook_url')) checked @endif>
                                        </span>
                                        <input name="facebook_url" type="text" id="input_facebook_url"
                                            @if (!old('facebook_url')) disabled @endif
                                            class="form-control @error('facebook_url') is-invalid @enderror"
                                            maxlength="255" value="{{ old('facebook_url') }}"
                                            placeholder="https://www.facebook.com/#">
                                        <div class="input-group-text"><i class="bi bi-facebook"></i></div>
                                        @error('facebook_url')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- twitter --}}
                                <div class="col-sm-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <input type="checkbox" id="cb_twitter" onchange="twitterUrlManage();"
                                                @if (old('twitter_url')) checked @endif>
                                        </span>
                                        <input name="twitter_url" type="text" id="input_twitter_url"
                                            @if (!old('twitter_url')) disabled @endif
                                            class="form-control @error('twitter_url') is-invalid @enderror"
                                            maxlength="255" value="{{ old('twitter_url') }}"
                                            placeholder="https://www.twitter.com/#">
                                        <div class="input-group-text"><i class="bi bi-twitter"></i></div>
                                        @error('twitter_url')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- linkedin --}}
                                <div class="col-sm-6">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <input type="checkbox" id="cb_linkedin" onchange="linkedinUrlManage();"
                                                @if (old('linkedin_url')) checked @endif>
                                        </span>
                                        <input name="linkedin_url" type="text" id="input_linkedin_url"
                                            @if (!old('linkedin_url')) disabled @endif
                                            class="form-control @error('linkedin_url') is-invalid @enderror"
                                            maxlength="255" value="{{ old('linkedin_url') }}"
                                            placeholder="https://www.linkedin.com/in/#">
                                        <div class="input-group-text"><i class="bi bi-linkedin"></i></div>
                                        @error('linkedin_url')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- btn submit --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Submit Button</label>
                        <div class="col-sm-10">
                            <button type="submit" id="btn_submit_form_create" class="btn btn-primary">Submit
                                Form</button>
                        </div>
                    </div>

                </form><!-- End Form Elements -->

            </div>
        </div>
    </section>

    <script>
        function count_up(obj) {
            document.getElementById('count1').innerHTML = "Character count: " + obj.value.length + "/800";
        }

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
