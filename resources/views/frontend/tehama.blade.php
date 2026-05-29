@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'ict',
    'deptImage'    => 'ict.webp',
    'deptIcon'     => 'fa-laptop-code',
    'deptColor'    => 'from-indigo-800',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_open',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
