@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'plumbing',
    'deptImage'    => 'ufundibomba.webp',
    'deptIcon'     => 'fa-faucet',
    'deptColor'    => 'from-cyan-800',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_form4',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
