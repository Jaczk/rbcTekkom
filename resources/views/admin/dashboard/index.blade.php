@extends('admin.layouts.base')

@section('title', 'Dasbor')

@section('content')
    {{-- <h1>ini dashboard</h1> --}}
    <div class="d-flex row justify-content-between"> {{-- row 1 --}}
        <div class="p-0 small-box bg-primary col">
            <div class="inner">
                <h3>{{ $books }}</h3>
                <p>Buku</p>
            </div>
            <div class="icon">
                <i class="fas fa-laptop-house"></i>
            </div>
            <a href="{{ route('admin.book') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        <div class="p-0 mx-3 small-box bg-success col">
            <div class="inner">
                <h3>{{ $inLoans }}</h3>
                <p>Peminjaman Berlangsung</p>
            </div>
            <div class="icon">
                <i class="fas fa-file"></i>
            </div>
            <a href="{{ route('admin.donate') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        <div class="p-0 small-box bg-danger col">
            <div class="inner">
                <h3>{{ $lateLoans }}</h3>
                <p>Peminjaman Terlambat</p>
            </div>
            <div class="icon">
                <i class="fas fa-people-carry"></i>
            </div>
            <a href="{{ route('admin.loans') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="d-flex row justify-content-between"> {{-- row 2 --}}
        <div class="p-0 small-box bg-dark col">
            <div class="inner">
                <h3>{{ $brokenBook }}</h3>
                <p>Buku Rusak</p>
            </div>
            <div class="icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <a href="{{ route('admin.book') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        <div class="p-0 mx-3 small-box bg-warning col">
            <div class="inner">
                <h3>{{ $donates }}</h3>
                <p>Buku Sumbangan</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('admin.donate') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
        <div class="p-0 small-box bg-info col">
            <div class="inner">
                <h3>1</h3>
                <p>Pengguna (No Admin)</p>
            </div>
            <div class="icon">
                <i class="fas fa-universal-access"></i>
            </div>
            <a href="{{ route('admin.loans') }}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #6998AB">
                        <h3 class="card-title">Tabel Buku</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="conditionChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-2">
        <div class="card card-primary">
            <div class="card-header" style="background-color: #6998AB">
                <h3 class="card-title">Frekuensi Peminjaman Buku per Periode</h3>
            </div>
            <div class="card-body">
                <canvas id="freqChart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <div class="card-footer ">
                <div class="d-flex justify-content-between">
                    <select name="period" id="pp" onchange="updateChart2(this)">
                        @foreach ($specBookDrop as $item)
                            <option value="{{ $item->period }}" @if ($item->period == $period) selected @endif>
                                {{ $item->period }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var conditionChartCanvas = $('#conditionChart').get(0).getContext('2d');
        var pieData = {
            labels: [
                @foreach ($specBooks as $spec)
                    '{{ $spec->desc }}', // Added single quotes and '->desc'
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($specBooks as $spec)
                        {{ $spec->count }}, // Added '->count'
                    @endforeach
                ],
                backgroundColor: [
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de',
                ],
            }]
        };
        // Create pie or doughnut chart
        // You can switch between pie and doughnut using the method below.
        new Chart(conditionChartCanvas, {
            type: 'pie',
            data: pieData,
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Ringkasan Tabel Kondisi Buku'
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script>
        var ctx2 = document.getElementById('freqChart').getContext('2d');
        var currentPeriod2 = "{{ $period }}";
        var myChart2;

        function fetchDataAndRenderChart2(period) {
            fetch('specChart/ajax/' + period)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data);

                    var chartData2 = {
                        labels: data.labels,
                        datasets: [{
                            data: data.datasets[0].data,
                            backgroundColor: data.datasets[0].backgroundColor,
                        }]
                    };

                    // Update the chart title
                    myChart2.options.plugins.title.text = 'Periode: ' + period;

                    // Update the chart data
                    myChart2.data = chartData2;

                    // Redraw the chart
                    myChart2.update();
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        }

        function renderChart2(chartData2) {
            myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: chartData2,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Periode: ' + currentPeriod2
                        },
                        legend: {
                            display: false,
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Initial chart rendering
        renderChart2({}); // Create an empty chart initially

        // Fetch and render chart data for the current period
        fetchDataAndRenderChart2(currentPeriod2);

        function updateChart2(option) {
            var selectedPeriod = option.value;
            fetchDataAndRenderChart2(selectedPeriod);
        }
    </script>
@endsection
