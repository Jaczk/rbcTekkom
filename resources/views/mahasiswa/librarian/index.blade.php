@extends('mahasiswa.layouts.base')

@section('title', 'Shift')

@section('content')

    <div class="p-3 poppins-text container-fluid">

        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <div class="mt-4 title fs-2 mb-4 fw-semibold">
                    Daftar Pustakawan
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-8 mx-auto">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach ($librarians as $librarian )
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex text-black">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/profile.png') }}"
                                            alt="Generic placeholder image" class="img-fluid"
                                            style="width: 100px; border-radius: 10px;">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-1">{{  Str::limit($librarian->name, 25) }}</h5>
                                        <p class="mb-1" style="color: #2b2a2a;">{{ $librarian->nim }}</p>
                                        <p class="" style="color: #2b2a2a;">{{ "Tekkom ".$librarian->year }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- First container -->

            </div>
        </div>

    </div>

@endsection

@section('js')

@endsection
