@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">
                        <i class="fas fa-users-cog me-2" style="color:#1e3a8a;"></i>
                        Kamati za Chuo
                    </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kamati za Chuo</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- PDF Viewer Card --}}
        <div class="row">
            <div class="col-12">
                <div class="card comman-shadow">
                    <div class="card-header">
                        <h5 class="m-0">
                            <i class="fas fa-file-pdf me-2 text-danger"></i>
                            Kamati za Chuo
                        </h5>
                    </div>
                    <div class="card-body p-2">
                        <iframe src="{{ asset('images/kamati-za-chuo.pdf') }}"
                                style="width:100% !important; height:650px !important; border:none !important; border-radius:8px;"
                                frameborder="0">
                            <p class="text-muted p-3">
                                Kivinjari chako hakisaidii kuonyesha PDF moja kwa moja.
                                <a href="{{ asset('images/kamati-za-chuo.pdf') }}" target="_blank">Bonyeza hapa kupakua.</a>
                            </p>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
