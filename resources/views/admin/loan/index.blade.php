@extends('admin.layouts.base')

@section('title', 'Peminjaman')

@section('content')

    @inject('carbon', 'Carbon\Carbon')

    <div class="row">
        <div class="col-md-12">
            {{-- for Chart --}}
            

            <div class="card card-primary">
                <div class="card-header" style="background-color: #6998AB">
                    <h3 class="card-title">Daftar Peminjaman</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <a href="{{ route('admin.loans.create') }}" class="btn btn-primary text-bold">+ Peminjaman</a>
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

                    <div class="row">
                        <div class="col-md-12">
                            <table id="loan" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Peminjam</th>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tenggat</th>
                                        <th>Tanggal Dikembalikan</th>
                                        <th>Periode</th>
                                        <th>Denda</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $lo)
                                        <tr>
                                            <td></td>
                                            <td>{{ $lo->user->name }}</td>
                                            <td>
                                                {{$lo->book->book_name}}
                                            </td>
                                            <td class="text-bold">{{ date('F j, Y h:i A', strtotime($lo->created_at)) }}

                                            </td>
                                            @if ($carbon::now()->greaterThan($lo->return_date) && $lo->is_returned === 0)
                                                <td class="text-danger text-bold">
                                                    {{ date('F j, Y h:i A', strtotime($lo->return_date)) }}</td>
                                            @else
                                                <td class="text-bold text-success">
                                                    {{ date('F j, Y h:i A', strtotime($lo->return_date)) }}</td>
                                            @endif {{-- date comparison --}}

                                            @if (($lo->is_returned) === 1)
                                                <td class="text-bold">
                                                    {{ date('F j, Y h:i A', strtotime($lo->updated_at)) }}</td>
                                            @else
                                                <td class="text-center">-</td>
                                            @endif

                                            <td>{{ $lo->period }}</td>
                                            <td>{{ $lo->fine }}</td>

                                            @if ($lo->is_returned == 0)
                                                <td class="text-warning font-weight-bold">{{ 'Dipinjam' }}</td>
                                            @elseif($lo->is_returned == 1)
                                                <td class="text-success font-weight-bold">{{ 'Dikembalikan' }}</td>
                                            @endif {{-- is_returned comparison --}}
                                            <td class="flex-row d-flex">
                                                <form method="POST" action="{{ route('admin.loans.return', $lo->id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="mx-1 btn btn-primary return-btn">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </button>
                                                </form>
                                                {{-- <a href="https://wa.me/{{ $lo->user->phone }}" class="btn btn-success"
                                                    target="_blank">
                                                    <i class="fab fa-whatsapp fa-lg"></i>
                                                </a> --}}
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
    {{-- <script>
        $('#good').DataTable();
    </script> --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#loan').DataTable({
                dom: 'lBfrtipl',
                buttons: [{
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] // Include columns 1 to 5 in the copy report
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Daftar Peminjaman Perkantas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] // Include columns 1 to 5in the Excel report
                            }
                        },
                        {
                            extend: 'pdf',
                            title: 'Daftar Peminjaman Perkantas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] // Include columns 1 to 5 in the PDF report
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Daftar Peminjaman Perkantas',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9] // Include columns 1 to 5 in the printed report
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

            // Apply event listener to return buttons
            $('#loan').on('click', '.return-btn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: 'Peminjaman akan ditandai sebagai dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3CCF4E',
                    cancelButtonColor: '#e31231',
                    confirmButtonText: 'Selesaikan Peminjaman!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form.submit();
                    }
                });
            });
        });
        // $(document).ready(function() {
        //     var lineChartCanvas = document.getElementById('lineChart').getContext('2d');
        //     var currentPeriod = "period";
        //     var myChart;

        //     function fetchDataAndRenderChart(period) {
        //         var url = "{{ route('admin.chart.loan.ajax', ':period') }}";
        //         url = url.replace(':period', period);

        //         fetch(url)
        //             .then(response => {
        //                 if (!response.ok) {
        //                     throw new Error('Network response was not OK');
        //                 }
        //                 return response.json();
        //             })
        //             .then(data => {
        //                 console.log('Received data:', data);

        //                 var chartData = {
        //                     labels: data.labels,
        //                     datasets: data.datasets.map(dataset => ({
        //                         label: dataset.label,
        //                         data: dataset.data,
        //                         backgroundColor: dataset.backgroundColor,
        //                         borderColor: dataset.borderColor,
        //                         fill: dataset.fill,
        //                         type: dataset.type
        //                     }))
        //                 };

        //                 // Destroy previous chart instance if exists
        //                 if (myChart) {
        //                     myChart.destroy();
        //                 }

        //                 // Render new chart
        //                 myChart = new Chart(lineChartCanvas, {
        //                     type: 'bar',
        //                     data: chartData,
        //                     options: {
        //                         responsive: true,
        //                         maintainAspectRatio: false,
        //                         plugins: {
        //                             title: {
        //                                 display: true,
        //                                 text: 'Periode: ' + period
        //                             },
        //                             legend: {
        //                                 display: true,
        //                                 position: 'bottom'
        //                             }
        //                         }
        //                     }
        //                 });
        //             })
        //             .catch(error => {
        //                 console.error('Error fetching chart data:', error);
        //             });
        //     }

        //     // Initial chart rendering
        //     fetchDataAndRenderChart(currentPeriod);

        //     // Update chart when period changes
        //     $('#loan_period').on('change', function() {
        //         var selectedPeriod = $(this).val();
        //         fetchDataAndRenderChart(selectedPeriod);
        //     });
        // });
    </script>
    
@endsection
