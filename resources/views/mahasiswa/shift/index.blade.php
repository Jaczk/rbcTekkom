@extends('mahasiswa.layouts.base')

@section('title', 'Shift')

@section('content')

    <div class="p-3 poppins-text container-fluid">

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="mt-4 title fs-2 mb-4">
                    Jam Kerja Pelayanan
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <table id="user" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th><strong>Hari\Jam</strong></th>
                            <th>{{ $shiftFirst->s1 }}</th>
                            <th>{{ $shiftFirst->s2 }}</th>
                            <th>{{ $shiftFirst->s3 }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shifts as $shift)
                            <tr>
                                <td > <strong>{{ $shift->day }}</strong></td>
                                <td>{{ $shift->s1 }}</td>
                                <td>{{ $shift->s2 }}</td>
                                <td>{{ $shift->s3 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="mt-2 fs-2 mb-4">
                    <h6>
                        Hari Tutup RBC: Sabtu dan Minggu serta setiap Hari Libur Nasional
                    </h6>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

@endsection
