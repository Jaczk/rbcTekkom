@extends('admin.layouts.base')

@section('title', 'Tugas Akhir')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #6998AB">
                    <h3 class="card-title">Daftar Pengguna</h3>
                </div>
                <div class="card-body">
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
                                        <th>#</th>
                                        <th>Judul TA</th>
                                        <th>Kategori</th>
                                        <th>Tahun</th>
                                        <th>Penulis</th>
                                        <th>Dosen Pembimbing 1</th>
                                        <th>Dosen Pembimbing 2</th>
                                        <th>File 1</th>
                                        <th>File 2</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($theses as $t)
                                        <tr>
                                            <td></td>
                                            <td>{{ $t->thesis_name }}</td>
                                            <td>{{ $t->spec->desc }}</td>
                                            <td>{{ $t->year }}</td>
                                            <td>{{ $t->user->full_name }}</td>
                                            <td>{{ $t->lec1->name }}</td>
                                            <td>{{ $t->lec2->name }}</td>
                                            <td>
                                                <a href="{{ asset('storage/pdf-1/' . $t->file_1) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            <td><a href="{{ asset('storage/pdf-2/' . $t->file_2) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            <td class="flex-row d-flex">
                                                <a href="{{ route('admin.theses.edit', Crypt::encryptString($t->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                                <form method="post" {{-- Delete Button --}}
                                                    action="{{ route('admin.theses.destroy', $t->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="mx-2 btn btn-danger delete-btn">
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
            var table = $('#user').DataTable();

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
            $('#user').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Item yang telah dihapus tidak dapat dikembalikan!',
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
        });
    </script>

    <script>
        function confirmResetForm(event) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Reset akses pengembalian ?',
                text: 'Aksi ini akan melakukan reset akses pengembalian pada semua anggota.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset',
                cancelButtonText: 'Kembali',
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, submit the form
                    event.target.form.submit();
                }
            });
        }
    </script>
@endsection
