@extends('admin.layouts.base')

@section('title', 'Shift')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #6998AB">
                    <h3 class="card-title">Jam Layanan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mx-2 mb-3">
                            <a href="{{ route('admin.shift.editTime') }}" class="btn btn-primary text-bold">Edit Jam Layanan</a>
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <table id="user" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Hari\Jam</th>
                                        <th>{{ $shiftFirst->s1 }}</th>
                                        <th>{{ $shiftFirst->s2 }}</th>
                                        <th>{{ $shiftFirst->s3 }}</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($shifts as $shift)
                                        <tr>
                                            <td>{{ $shift->day }}</td>
                                            <td>{{ $shift->s1 }}</td>
                                            <td>{{ $shift->s2 }}</td>
                                            <td>{{ $shift->s3 }}</td>
                                            <td class="flex-row d-flex">
                                                <a href="{{ route('admin.shift.edit', Crypt::encryptString($shift->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#user').DataTable({
                ordering: false // Disable ordering
            });
        });
    </script>

@endsection
