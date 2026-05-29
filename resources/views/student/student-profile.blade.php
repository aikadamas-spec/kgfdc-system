@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- 1. TOP HEADER (BACK & PRINT) -->
        <div class="page-header mb-4 no-print">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title text-primary font-black uppercase">Official Student Profile</h3>
                </div>
                <div class="col-auto d-flex gap-2">
                    <a href="{{ route('student/list') }}" class="btn btn-dark rounded-pill px-4 font-black shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> BACK TO LIST
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4 font-black shadow-sm">
                        <i class="fas fa-print me-2"></i> PRINT PROFILE
                    </button>
                </div>
            </div>
        </div>

        <!-- THE UNIFIED CARD -->
        <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
            
            <!-- BLUE BANNER WITH PHOTO AND NAMES -->
            <div class="p-4 d-flex align-items-center justify-content-between" style="background-color: #0d6efd !important;">
                <div class="d-flex align-items-center">
                    <img src="{{ $student->passport_photo ? asset($student->passport_photo) : asset('assets/img/default-avatar.png') }}" 
                         class="rounded-circle border border-3 border-white shadow" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                    <div class="ms-4">
                        <h2 class="font-black uppercase mb-0" style="color: #000000 !important; font-weight: 900 !important; letter-spacing: -1px;">
                            {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                        </h2>
                        <p class="mb-0 font-bold uppercase" style="color: #333333; font-size: 0.8rem; opacity: 0.8;">STUDENT PROFILE</p>
                    </div>
                </div>
                <div class="text-end">
                    <span class="font-black uppercase" style="color: #000000 !important; font-size: 1.2rem; font-weight: 900 !important;">
                        {{ $student->course ?? $student->course_applied ?? 'N/A' }}
                    </span>
                </div>
            </div>

            <div class="card-body p-5 bg-white">
                
                <!-- SECTION 1: PERSONAL INFO (Grid 3) -->
                <h6 class="font-black border-bottom pb-2 mb-4 text-primary uppercase"><i class="fas fa-user-circle me-2"></i> 1. PERSONAL INFORMATION</h6>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Reg. Number</small><strong>{{ $student->admission_id }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">NIDA Number</small><strong>{{ $student->nida_number ?? '---' }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Gender</small><strong>{{ $student->gender }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Date of Birth</small><strong>{{ $student->date_of_birth }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Education Level</small><strong>{{ $student->education_level ?? '---' }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Phone Number</small><strong>{{ $student->phone_number }}</strong></div>
                    <div class="col-md-12"><small class="text-muted d-block text-uppercase font-bold">Email Address</small><strong>{{ $student->email ?? '---' }}</strong></div>
                </div>

                <!-- SECTION 2: RESIDENCE (Grid 3) -->
                <h6 class="font-black border-bottom pb-2 mb-4 text-primary uppercase"><i class="fas fa-map-marker-alt me-2"></i> 2. RESIDENCE & CONTACT</h6>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Region</small><strong>{{ $student->region }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">District</small><strong>{{ $student->district }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Ward</small><strong>{{ $student->ward }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Street</small><strong>{{ $student->street }}</strong></div>
                </div>

                <!-- SECTION 3: FATHER'S INFO (Grid 3) -->
                <h6 class="text-dark uppercase mb-3 border-bottom pb-2" style="font-weight: 700 !important; color: #000000 !important;">FATHER'S DETAILS</h6>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Full Name</small><strong>{{ $student->father_first_name }} {{ $student->father_middle_name }} {{ $student->father_last_name }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Phone</small><strong>{{ $student->father_phone }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Region/District</small><strong>{{ $student->father_region }}, {{ $student->father_district }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Ward/Street</small><strong>{{ $student->father_ward }}, {{ $student->father_street }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Address</small><strong>{{ $student->father_address }}</strong></div>
                </div>

                <!-- SECTION 4: MOTHER'S INFO (Grid 3) -->
                <h6 class="text-dark uppercase mb-3 border-bottom pb-2" style="font-weight: 700 !important; color: #000000 !important;">MOTHER'S DETAILS</h6>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Full Name</small><strong>{{ $student->mother_first_name }} {{ $student->mother_middle_name }} {{ $student->mother_last_name }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Phone</small><strong>{{ $student->mother_phone }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Region/District</small><strong>{{ $student->mother_region }}, {{ $student->mother_district }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Ward/Street</small><strong>{{ $student->mother_ward }}, {{ $student->mother_street }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Address</small><strong>{{ $student->mother_address }}</strong></div>
                </div>

                <!-- SECTION 5: GUARDIAN INFO (Grid 3) -->
                <h6 class="text-dark uppercase mb-3 border-bottom pb-2" style="font-weight: 700 !important; color: #000000 !important;">GUARDIAN'S DETAILS</h6>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Full Name</small><strong>{{ $student->guardian_first_name }} {{ $student->guardian_middle_name }} {{ $student->guardian_last_name }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Phone</small><strong>{{ $student->guardian_phone }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Location</small><strong>{{ $student->guardian_region }}, {{ $student->guardian_district }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Ward/Street</small><strong>{{ $student->guardian_ward }}, {{ $student->guardian_street }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Address</small><strong>{{ $student->guardian_address }}</strong></div>
                </div>

                <!-- SECTION 6: SPONSOR INFO (Grid 3) -->
                <h6 class="font-black border-bottom pb-2 mb-4 text-primary uppercase"><i class="fas fa-hand-holding-usd me-2"></i> 3. SPONSOR / GUARANTOR INFORMATION</h6>
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Organization</small><strong>{{ $student->sponsor_organization ?? 'SELF SPONSORED' }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Sponsor Phone</small><strong>{{ $student->sponsor_phone }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Sponsor Email</small><strong>{{ $student->sponsor_email }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Supervisor Name</small><strong>{{ $student->sponsor_first_name }} {{ $student->sponsor_middle_name }} {{ $student->sponsor_last_name }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Title/Position</small><strong>{{ $student->sponsor_title }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Region/District</small><strong>{{ $student->sponsor_region }}, {{ $student->sponsor_district }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Ward/Street</small><strong>{{ $student->sponsor_ward }}, {{ $student->sponsor_street }}</strong></div>
                    <div class="col"><small class="text-muted d-block text-uppercase font-bold">Business</small><strong>{{ $student->sponsor_business }}</strong></div>
                </div>

                <!-- MEDICAL FORM BUTTON -->
                <div class="text-center border-top pt-5 pb-5">
                    <a href="{{ asset($student->medical_form) }}" target="_blank" 
                       class="btn btn-outline-primary rounded-pill px-5 py-3 shadow-sm" 
                       style="border: 1.5px solid #0d6efd !important; font-weight: 900 !important; letter-spacing: 1px; font-size: 1.1rem; min-width: 350px;">
                        <i class="fas fa-file-medical me-3" style="font-size: 1.3rem;"></i> 
                        VERIFY MEDICAL FORM
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
