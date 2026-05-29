@extends('layouts.frontend')

@section('content')
@include('frontend.partials.dept_page', [
    'deptKey'      => 'domestic_elec',
    'deptImage'    => 'umememajumbani.webp',
    'deptIcon'     => 'fa-bolt',
    'deptColor'    => 'from-orange-700',
    'deptDuration' => 'dept_both_duration',
    'deptReq'      => 'dept_req_form4',
    'deptCert'     => 'dept_cert_nactvet',
])
@endsection
