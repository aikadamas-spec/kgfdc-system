@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'masonry',
    'deptImage'    => 'uashi.webp',
    'deptIcon'     => 'fa-trowel-bricks',
    'deptColor'    => 'from-stone-700',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_form4',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
