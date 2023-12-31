@extends('admin.layouts.base')

@section('title', 'Galeri')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #6998AB">
                    <h3 class="card-title">Galeri Foto</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mx-2 mb-3">
                            <a href="{{ route('admin.facility.gallery.create') }}" class="btn btn-primary text-bold">+ Tambah Foto Galeri</a>
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
                            <table id="facility" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Caption</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gallery as $index => $g)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $g->caption }}</td>
                                            <td class="text-center"><img src="{{ asset('storage/facility/' . $g->image) }}" class="img-fluid"
                                                    style="width: 180px" alt="Image"></td>
                                            <td class="flex-row d-flex">
                                                <a href="{{ route('admin.facility.gallery.edit', Crypt::encryptString($g->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.facility.gallery.destroy', $g->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-2 btn btn-danger">
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
            // Apply event listener to all delete buttons
            $('#facility').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Buku Akan Dihapus dari Tabel!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e31231',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus item!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form.submit();
                    }
                });
            });
            var table = $('#facility').DataTable();
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

        });
    </script>
@endsection
