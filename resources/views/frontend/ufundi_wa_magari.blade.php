@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'mechanic',
    'deptImage'    => 'ufundimagari.webp',
    'deptIcon'     => 'fa-car',
    'deptColor'    => 'from-blue-800',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_form4',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
