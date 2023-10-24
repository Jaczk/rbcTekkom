@extends('admin.layouts.base')

@section('title', 'Daftar Buku')

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
                        <h3 class="card-title">Daftar Buku</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <a href="{{ route('admin.book.create') }}" class="btn btn-primary text-bold"> <span><i
                                            class="fas fa-plus"></i></span> Buku</a>
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
                                            {{-- <th>ID</th> --}}
                                            <th>Nama</th>
                                            <th>Peminatan</th>
                                            <th>Detail Minat</th>
                                            <th>Kode Perpus</th>
                                            {{-- <th>Penerbit</th>
                                            <th>Penulis</th>
                                            <th>Kondisi</th> --}}
                                            <th>Rekomendasi</th>
                                            <th>Ketersediaan</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($books as $book)
                                            <tr>
                                                <td></td>
                                                {{-- <td>{{ $good->id }}</td> --}}
                                                <td>{{ $book->book_name }}</td>
                                                <td>{{ $book->specialization->desc ?? '-' }}</td>
                                                <td>{{ $book->specDetail->desc }}</td>
                                                <td>{{ $book->lib_book_code }}</td>
                                                {{-- <td>{{ $book->publisher ?? '-' }}</td>
                                                <td>{{ $book->author }}</td>
                                                <td>
                                                    {{ $book->condition == 'new' ? 'BARU' : ($book->condition == 'normal' ? 'NORMAL' : 'RUSAK') }}
                                                </td> --}}
                                                @if ($book->is_recommended == 0)
                                                    <td class="text-center">
                                                        <i class="fas fa-times fa-lg" style="color: #e00043;"></i>
                                                    </td>
                                                @else
                                                    <td class="text-center text-success font-weight-bold">
                                                        <i class="fas fa-check fa-lg" style="color: #19942e;"></i>
                                                    </td>
                                                @endif
                                                
                                                @if ($book->is_available == 0)
                                                    <td class="text-center">
                                                        <p class="text-danger text-bold">Tidak Ada</p>
                                                    </td>
                                                @else
                                                    <td class="text-center text-success font-weight-bold">
                                                        <p class="text-success text-bold">Ada</p>
                                                    </td>
                                                @endif
                                                {{-- <td>{{ $book->is_available == '0' ? "Not Available" : "Ready"}}</td> --}}
                                                <td class="text-center">
                                                    <img src="{{ filter_var($book->image, FILTER_VALIDATE_URL) ? $book->image : asset('storage/images/' . $book->image) }}"
                                                        class="img-fluid" style="width: 180px" alt="Image">
                                                </td>
                                                <td class="flex-row d-flex">
                                                    <a href="{{ route('admin.book.edit', Crypt::encryptString($book->id)) }}"
                                                        class="btn btn-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="post"
                                                        action="{{ route('admin.book.destroy', $book->id) }}">
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
            });
            //-------------
        </script>
    @endsection
