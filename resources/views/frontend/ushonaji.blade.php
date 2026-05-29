@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'tailoring',
    'deptImage'    => 'ushonaji.webp',
    'deptIcon'     => 'fa-cut',
    'deptColor'    => 'from-pink-700',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_open',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
