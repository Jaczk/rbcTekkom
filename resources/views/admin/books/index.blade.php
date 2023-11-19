@extends('admin.layouts.base')

@section('title', 'Daftar Buku')

@section('content')

    <div class="row">
        <div class="col-md-12">
            {{-- for Chart --}}
            <div>
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #6998AB">
                        <h3 class="card-title">Daftar Buku</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mx-2 mb-3">
                                <a href="{{ route('admin.book.create') }}" class="btn btn-primary text-bold">+ Buku</a>
                            </div>
                            <div class="mx-2 mb-3">
                                <a href="#" class="btn btn-warning text-bold" data-toggle="modal"
                                    data-target="#selectBooksModal"><span><i class="fas fa-file-pdf">
                                        </i></span> Label Buku</a>
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
                                            <th>Nama</th>
                                            <th>Peminatan</th>
                                            <th>Detail Minat</th>
                                            <th>Kode Perpus</th>
                                            <th>Rekomendasi</th>
                                            <th>Ketersediaan</th>
                                            <th>Gambar</th>
                                            <th>QR Code</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($books as $book)
                                            <tr>
                                                <td></td>
                                                <td>{{ $book->book_name }}</td>
                                                <td>{{ $book->specialization->desc ?? '-' }}</td>
                                                <td>{{ $book->specDetail->desc }}</td>
                                                <td>{{ $book->lib_book_code }}</td>
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
                                                <td class="text-center">
                                                    <img src="{{ asset('storage/qr-images/' . $book->qr_code) }}"
                                                        class="img-fluid" style=" width:150px" alt="QR Code">
                                                </td>
                                                <td>
                                                    <div class="flex-row d-flex">
                                                        <div class="mx-1">
                                                            <a href="javascript:void(0)" class="btn btn-primary"
                                                                id="show-detail"
                                                                data-url="{{ route('admin.book.show', $book->id) }}">
                                                                <i class="fas fa-eye" style="color: #ffffff;"></i>
                                                            </a>
                                                        </div>
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
                                                    </div>
                                                    <div class="flex-row mt-2 ml-1 d-flex">
                                                        <a href="{{ route('admin.bookLabel.generateLabel', ['bookId' => $book->id]) }}"
                                                            class="mr-2 btn-warning btn">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                        {{-- <a href="{{ route('admin.bookLabel.generateWordLabel', ['bookId' => $book->id]) }}" class="btn-warning btn">
                                                            <i class="fas fa-file-word"></i>
                                                        </a> --}}
                                                    </div>
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
            <div class="modal-dialog modal-dialog-centered">
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
                                    <th>Peminatan</th>
                                    <td><span id="book-spec"></span></td>
                                </tr>
                                <tr>
                                    <th>Detail Minat</th>
                                    <td><span id="book-spec_detail"></span></td>
                                </tr>
                                <tr>
                                    <th>Kode Perpus</th>
                                    <td><span id="book-lib"></span></td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td><span id="book-publisher"></span></td>
                                </tr>
                                <tr>
                                    <th>Penulis</th>
                                    <td><span id="book-author"></span></td>
                                </tr>
                                <tr>
                                    <th>ISBN-ISSN</th>
                                    <td><span id="book-isbn_issn"></span></td>
                                </tr>
                                <tr>
                                    <th>Tahun Masuk</th>
                                    <td><span id="book-year"></span></td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td><span id="book-condition"></span></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td><span id="book-desc"></span></td>
                                </tr>
                                <tr>
                                    <th>QR</th>
                                    <td><span id="book-qrimage"></span></td>
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

        <!--Label Filtering Modal -->
        <div class="modal fade" id="selectBooksModal" tabindex="-1" aria-labelledby="selectBooksModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="selectBooksModalLabel">Select Books for Labels</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Include a form for filtering and selecting books -->
                        <form method="post" action="{{ route('admin.bookLabel.generateAllBookLabels') }}">
                            @csrf
                            <h5>Semua Buku? <span><input type="checkbox" value="1" id="all"
                                        name="all"></span></h5>
                            <h5>Buku Peminatan</h5>
                            <select name="specID" id="specID">
                                <option value="">Pilih Peminatan </option>
                                @foreach ($specDrops as $spec)
                                    <option value="{{ $spec->id }}">
                                        {{ $spec->desc }}
                                    </option>
                                @endforeach
                            </select>
                            <h5>Buku Detail Peminatan</h5>
                            <select name="specDetailID" id="specDetailID">
                                <option value="">Pilih Detail Peminatan</option>
                                @foreach ($specDetailDrops as $specd)
                                    <option value="{{ $specd->id }}">
                                        {{ $specd->desc }}
                                    </option>
                                @endforeach
                            </select>
                            <h5>Tahun Masuk</h5>
                            <select name="yearEntry" id="yearEntry">
                                <option value="">Pilih Tahun Masuk</option>
                                @foreach ($yearEntries as $year)
                                    <option value="{{ $year->year_entry }}">
                                        {{ $year->year_entry }}
                                    </option>
                                @endforeach
                            </select>
                            <br> <br>
                            <!-- Add form fields for filtering books, e.g., checkboxes or input fields -->
                            <button type="submit" class="btn btn-primary">Generate Labels</button>
                        </form>
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
                    $('#book-publisher').text(data.publisher);
                    $('#book-author').text(data.author);
                    $('#book-isbn_issn').text(data.isbn_issn);
                    $('#book-condition').text(data.condition);
                    $('#book-year').text(data.year_entry);
                    $('#book-desc').text(data.desc);
                    $('#book-spec').text(data.specialization.desc);
                    $('#book-lib').text(data.lib_book_code);
                    $('#book-spec_detail').text(data.spec_detail.desc);

                    // Set the source of the QR image
                    var QRimagePath = "{{ asset('storage/qr-images/') }}/" + data.qr_code;

                    // Append an <img> element to the corresponding <td>
                    $('#book-qrimage').html('<img src="' + QRimagePath +
                        '" class="img-fluid" style="width: 200px" alt="QR Code">');
                });
            });

        });
        //-------------
    </script>

    <script>
        // Disable other inputs when the checkbox is checked
        $('#all').change(function() {
            if ($(this).is(':checked')) {
                // Checkbox is checked, disable other inputs
                $('#specID, #specDetailID, #yearEntry').prop('disabled', true);
                $('#specID, #specDetailID, #yearEntry').selectpicker('refresh');
            } else {
                // Checkbox is unchecked, enable other inputs
                $('#specID, #specDetailID, #yearEntry').prop('disabled', false);
                $('#specID, #specDetailID, #yearEntry').selectpicker('refresh');
            }
        });

        // Disable the checkbox and other dropdowns when a dropdown is selected
        $('#specID, #specDetailID, #yearEntry').change(function() {
            if ($(this).val() !== '') {
                // Dropdown is selected, disable the checkbox and other dropdowns
                $('#all, #specID, #specDetailID, #yearEntry').not(this).prop('disabled', true);
                $('#all, #specID, #specDetailID, #yearEntry').selectpicker('refresh');
            } else {
                // Dropdown is cleared, enable the checkbox and other dropdowns
                $('#all, #specID, #specDetailID, #yearEntry').prop('disabled', false);
                $('#all, #specID, #specDetailID, #yearEntry').selectpicker('refresh');
            }
        });
    </script>


@endsection
