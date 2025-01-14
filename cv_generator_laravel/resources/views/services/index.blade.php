@extends('templates.master_user')
@section('content')
    <div class="pagetitle">
        <h1>My Services</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">My Service</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Service</h5>

                {{-- session message --}}
                @if (session()->has('pesan_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('pesan_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('pesan_warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session()->get('pesan_warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('pesan_error'))
                    <div class="alert alert-error alert-dismissible fade show" role="alert">
                        {{ session()->get('pesan_error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- table My Service -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name of Service</th>
                                <th scope="col">Service Details</th>
                                <th scope="col">Action Button</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($services) > 0)
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($services as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->service_name }}</td>
                                        <td>{{ $item->service_detail }}</td>
                                        <td>
                                            {{-- btn-edit --}}
                                            <a href="{{ route('detail_services_create', ['service_id' => $item->id]) }}"
                                                class="btn btn-sm btn-primary" title="Advance data">Advance</a>

                                            {{-- btn-edit --}}
                                            <a href="{{ route('services.edit', ['service' => $item->id]) }}"
                                                class="btn btn-sm btn-warning" title="Wanna edit this service?">Edit</a>

                                            {{-- btn hapus --}}
                                            <button class="btn btn-sm btn-danger btn-hapus"
                                                title="Are you sure you want to delete this data?"
                                                data-id="{{ $item->id }}" data-value="{{ $item->service_name }}"
                                                data-bs-toggle="modal" data-bs-target="#modal-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td scope="row" colspan="4"><i>You haven't added anything</i></td>
                            @endif
                        </tbody>
                        @if (count($services) < 6)
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <a href="{{ route('services.create') }}" style="float: right"
                                            class="btn btn-sm btn-primary">Add new service data (max:6)</a>
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
                <!-- End table My Service -->
            </div>
        </div>
    </section>

    {{-- Modal Delete --}}
    <div class="modal fade" id="modal-sm" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST" id="formDelete"
                    onsubmit="document.getElementById('btn-submit-delete').disabled = true">
                    @method('DELETE')
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">Are you Sure?</h4>
                        <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="mb-konfirmasi">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">No</button>
                        <button id="btn-submit-delete" type="submit" class="btn btn-danger">Yes, delete it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // jika tombol hapus ditekan, generate alamat URL untuk proses hapus
        // id disini adalah id data yang akan dihapus
        document.querySelectorAll('.btn-hapus').forEach(function(button) {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                document.getElementById('formDelete').setAttribute('action', '/services/' + id);

                let value = this.getAttribute('data-value');
                document.getElementById('mb-konfirmasi').textContent =
                    "Are you sure you want to delete your service data about : " + value + " ?";
            });
        });

        // jika tombol Ya, hapus ditekan, submit form hapus
        document.getElementById('formDeleteSubmit').addEventListener('click', function() {
            document.getElementById('formDelete').submit();
        });
    </script>

@endsection
