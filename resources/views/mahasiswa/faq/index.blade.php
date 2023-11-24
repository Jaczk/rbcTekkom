@extends('mahasiswa.layouts.base')

@section('title', 'Shift')

@section('content')

    <div class="p-3 poppins-text container-fluid">

        <div class="row">
            <div class="col-md-6 mx-auto">
                <article class="my-3 fs-5">
                    {!! $text->desc !!}
                </article>
            </div>
        </div>


    </div>

@endsection

@section('js')

@endsection
