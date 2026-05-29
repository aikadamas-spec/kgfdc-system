@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'welding',
    'deptImage'    => 'uchomeleaji.webp',
    'deptIcon'     => 'fa-fire',
    'deptColor'    => 'from-red-800',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_form4',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
