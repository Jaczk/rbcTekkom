@extends('admin.layouts.base')

@section('title', 'Daftar Buku Sumbangan')

@section('content')

    <div class="row">
        <div class="col-md-12">
            {{-- for Chart --}}
            <div>
                {{-- <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header" style="background-color: #121F3E">
                                    <h3 class="card-title">Tabel Ketersediaan Barang</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header" style="background-color: #121F3E">
                                    <h3 class="card-title">Tabel Barang Berdasarkan Kategori</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart2"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #6998AB">
                        <h3 class="card-title">Daftar Buku Sumbangan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <a href="{{ route('admin.donate.create') }}" class="btn btn-primary text-bold">+ Buku</a>
                            </div>
                        </div>

                        {{-- Alert w/ session --}}
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
                                <table id="book" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Buku</th>
                                            <th>Harga</th>
                                            <th>Penerbit</th>
                                            <th>Penulis</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($donates as $donate)
                                            <tr>
                                                <td></td>
                                                <td>{{ $donate->book_name }}</td>
                                                <td>{{ $donate->price ?? '-' }}</td>
                                                <td>{{ $donate->publisher }}</td>
                                                <td>{{ $donate->author }}</td>
                                                <td class="text-center">
                                                    <img src="{{ filter_var($donate->image, FILTER_VALIDATE_URL) ? $donate->image : asset('storage/images/' . $donate->image) }}"
                                                        class="img-fluid" style="width: 180px" alt="Image">
                                                </td>
                                                <td class="flex-row d-flex">
                                                    <div class="mx-1">

                                                        <a href="javascript:void(0)" class="btn btn-primary"
                                                            id="show-detail"
                                                            data-url="{{ route('admin.donate.show', $donate->id) }}">
                                                            <i class="fas fa-eye" style="color: #ffffff;"></i>
                                                        </a>

                                                    </div>
                                                    <a href="{{ route('admin.donate.edit', Crypt::encryptString($donate->id)) }}"
                                                        class="btn btn-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="post"
                                                        action="{{ route('admin.donate.destroy', $donate->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="mx-1 btn btn-danger delete-btn">
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
        <!-- Modal -->
        <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Buku</th>
                                    <td><span id="book-name"></span></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td><span id="book-desc"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
            var table = $('#book').DataTable({
                dom: 'lBfrtipl',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include columns 1 to 5 in the copy report
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Daftar Buku',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include columns 1 to 5 in the Excel report
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Daftar Buku',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include columns 1 to 5 in the PDF report
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Daftar Buku',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include columns 1 to 5 in the printed report
                        }
                    }
                ],
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0
                }],
                order: [
                    [1, 'asc']
                ]
            });

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
            $('#book').on('click', '.delete-btn', function(e) {
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

            //Modal dialog
            $('body').on('click', '#show-detail', function() {
                var userURL = $(this).data('url');
                $.get(userURL, function(data) {
                    $('#userShowModal').modal('show');
                    $('#book-name').text(data.book_name);
                    $('#book-desc').text(data.desc);
                })
            });
        });
        //-------------
    </script>
@endsection
