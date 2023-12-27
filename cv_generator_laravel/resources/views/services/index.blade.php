@extends('templates.master_user')
@section('content')
    <div class="pagetitle">
        <h1>General Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Service</h5>

                <!-- My Service -->
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Brandon Jacob</td>
                                <td>Designer</td>
                                <td>
                                    <button>Edit</button>
                                    <button>Delete</button>
                                </td>
                            </tr>
                        @else
                            <td scope="row" colspan="4"><i>You haven't added anything</i></td>
                        @endif
                    </tbody>
                    @if (count($services) < 6)
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <a href="{{ route('services.create') }}" style="float: right"
                                        class="btn btn-sm btn-primary">Add new Service</a>
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
                <!-- End Default Table Example -->
            </div>
        </div>
    </section>
@endsection
