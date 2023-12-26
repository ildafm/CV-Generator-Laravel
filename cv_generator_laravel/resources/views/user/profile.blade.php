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
                            @if (isset($contact->twitter_url))
                                <a href="{{ $contact->twitter_url }}" class="twitter"><i class="bi bi-twitter"></i></a>
                            @endif

                            @if (isset($facebook->twitter_url))
                                <a href="{{ $facebook->twitter_url }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            @endif

                            @if (isset($instagram->twitter_url))
                                <a href="{{ $instagram->twitter_url }}" class="instagram"><i
                                        class="bi bi-instagram"></i></a>
                            @endif

                            @if (isset($linke_id->twitter_url))
                                <a href="{{ $linke_id->twitter_url }}" class="linkeid"><i class="bi bi-linkeid"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

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
                                    data-bs-target="#profile-settings">Settings</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change
                                    Password</button>
                            </li>

                        </ul>

                        {{-- tab content --}}
                        <div class="tab-content pt-2">

                            {{-- overview tab --}}
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About me</h5>
                                <p class="small fst-italic">
                                    @if (isset($user->about_me))
                                        {{ $user->about_me }}
                                    @else
                                        <i>You haven't added anything about yourself</i>
                                    @endif
                                </p>

                                <h5 class="card-title">Profile Details</h5>

                                {{-- full name --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                {{-- address --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (isset($user->address))
                                            {{ $user->address }}
                                        @else
                                            <i>No address added yet</i>
                                        @endif
                                    </div>
                                </div>

                                {{-- phone --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (isset($contact->phone))
                                            {{ $contact->phone }}
                                        @else
                                            <i>No number added yet</i>
                                        @endif
                                    </div>
                                </div>

                                {{-- email --}}
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                            </div>

                            {{-- profile edit form --}}
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST"
                                    action="{{ route('users.update', ['user' => $user->id, 'category' => 'basic_update']) }}">
                                    @method('PUT')
                                    @csrf

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
                                            <input name="name" type="text" class="form-control" id="name"
                                                value="{{ old('name', $user->name) }}" required
                                                placeholder="Insert your full name, max:255 characters">
                                        </div>
                                    </div>

                                    {{-- about me --}}
                                    <div class="row mb-3">
                                        <label for="about_me" class="col-md-4 col-lg-3 col-form-label">About</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="about_me" class="form-control" id="about_me" style="height: 100px"
                                                placeholder="Insert about yourself, max:1000 characters">{{ old('about_me', $user->about_me) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- address --}}
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="address"
                                                value="{{ old('address', $user->address) }}"
                                                placeholder="Insert your full address, max:700 characters">
                                        </div>
                                    </div>

                                    {{-- phone number --}}
                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone"
                                                value="{{ old('phone', $contact->phone) }}"
                                                placeholder="Insert your active whatsapp phone number. ex: 081...">
                                        </div>
                                    </div>

                                    {{-- twitter profile --}}
                                    <div class="row mb-3">
                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="twitter" type="text" class="form-control" id="Twitter"
                                                value="{{ old('twitter', $contact->twitter_url) }}"
                                                placeholder="https://twitter.com/#">
                                        </div>
                                    </div>

                                    {{-- facebook profile --}}
                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="text" class="form-control" id="Facebook"
                                                value="{{ old('facebook', $contact->facebook_url) }}"
                                                placeholder="https://facebook.com/#">
                                        </div>
                                    </div>

                                    {{-- instagram profile --}}
                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instagram" type="text" class="form-control" id="Instagram"
                                                value="{{ old('instagram', $contact->instagram_url) }}"
                                                placeholder="https://instagram.com/#">
                                        </div>
                                    </div>

                                    {{-- linkedin profile --}}
                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                                value="{{ old('linkedin', $contact->linked_in_url) }}"
                                                placeholder="https://instagram.com/#">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                            Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify"
                                                    checked disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

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
