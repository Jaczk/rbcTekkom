@extends('admin.layouts.base')

@section('title', 'Peminatan')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #121F3E">
                    <h3 class="card-title">Daftar Peminatan</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('admin.special.create') }}" class="btn btn-primary text-bold">+ Peminatan</a>
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
                            <table id="specializations" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>Id</th> --}}
                                        <th>Kode Peminatan</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($specializations as $special)
                                        <tr>
                                            <td></td>
                                            {{-- <td>{{ $category->id }} </td> --}}
                                            <td>{{ $special->spec_char }} </td>
                                            <td>{{ $special->desc }} </td>
                                            <td class="flex-row d-flex">
                                                <a href="{{ route('admin.special.edit', Crypt::encryptString($special->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="post"
                                                    action="{{ route('admin.special.destroy', $special->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger mx-2 delete-btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
            var table = $('#specializations').DataTable();
            table
                .on('order.dt search.dt', function() {
                    var i = 1;

                    table
                        .cells(null, 0, {
                            search: 'applied',
                            order: 'applied'
                        })
                        .every(function(cell) {
                            this.data(i++);
                        });
                })
                .draw();
            // Apply event listener to all delete buttons
            $('#specializations').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Peminatan akan Dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e31231',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
