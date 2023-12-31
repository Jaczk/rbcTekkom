@extends('admin.layouts.base')

@section('title', 'Capstone')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #6998AB">
                    <h3 class="card-title">Daftar Capstone</h3>
                </div>
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="mx-2 mb-3">
                            <a href="{{ route('admin.capstone.all') }}" class="btn btn-primary text-bold">Edit Capstone</a>
                        </div>
                    </div> --}}
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
                                        <th>Judul Capstone</th>
                                        <th>Kategori</th>
                                        <th>Tahun</th>
                                        <th>Tim</th>
                                        <th>Anggota</th>
                                        <th>Dosen Pembimbing 1</th>
                                        <th>Dosen Pembimbing 2</th>
                                        <th>c100</th>
                                        <th>c200</th>
                                        <th>c300</th>
                                        <th>c400</th>
                                        <th>c500</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($capstones as $t)
                                        <tr>
                                            <td></td>
                                            <td>{{ $t->capstone_title }}</td>
                                            <td>{{ $t->spec->desc }}</td>
                                            <td>{{ $t->year }}</td>
                                            <td>{{ $t->team_name }}</td>
                                            <td>
                                                {{ $t->member1->name }} <br>
                                                {{ $t->member2->name }} <br>
                                                {{ $t->member3->name }} 
                                            </td>
                                            <td>{{ $t->lec1->name }}</td>
                                            <td>{{ $t->lec2->name }}</td>
                                            <td>
                                                <a href="{{ asset('storage/c100/' . $t->c100) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            <td><a href="{{ asset('storage/c200/' . $t->c200) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            <td><a href="{{ asset('storage/c300/' . $t->c300) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            <td><a href="{{ asset('storage/c400/' . $t->c400) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            <td><a href="{{ asset('storage/c500/' . $t->c500) }}" target="_blank"><i
                                                        class="fas fa-file-pdf"></i></a>
                                            </td>
                                            {{-- <td class="flex-row d-flex">
                                                <a href="{{ route('admin.capstone.edit', Crypt::encryptString($t->id)) }}"
                                                    class="btn btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                                <form method="post"
                                                    action="{{ route('admin.capstone.destroy', $t->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="mx-2 btn btn-danger delete-btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> --}}
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
