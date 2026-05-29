@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'auto_elec',
    'deptImage'    => 'umememagari.webp',
    'deptIcon'     => 'fa-car-battery',
    'deptColor'    => 'from-yellow-700',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_form4',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
