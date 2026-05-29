@extends('layouts.master')
@section('content')
<style>
    .font-black { font-weight: 900 !important; }
    .upload-btn-primary:hover { background-color: #0d6efd !important; color: #ffffff !important; border-style: solid !important; }
    .upload-btn-danger:hover { background-color: #dc3545 !important; color: #ffffff !important; border-style: solid !important; }
</style>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title text-primary font-black uppercase">New Student Registration</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('student/list') }}" class="btn btn-dark rounded-pill px-4 font-black shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> BACK TO LIST
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-lg border-0" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <form action="{{ route('student/add/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Validation Error Display --}}
                            @if ($errors->any())
                                <div class="alert alert-danger rounded-3 mb-4">
                                    <strong><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger rounded-3 mb-4">
                                    <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success rounded-3 mb-4">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                </div>
                            @endif

                            <!-- 1. STUDENT INFORMATION (Grid 3) -->
                            <h6 class="border-bottom pb-2 mb-4" style="color: #0d6efd !important; font-weight: 600 !important; text-transform: uppercase;">
                                <i class="fas fa-user-circle me-2"></i> Student Information
                            </h6>
                            <div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
                                <div class="col"><label class="small font-bold">First Name</label><input type="text" name="first_name" class="form-control" required></div>
                                <div class="col"><label class="small font-bold">Middle Name</label><input type="text" name="middle_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Last Name</label><input type="text" name="last_name" class="form-control" required></div>
                                <div class="col"><label class="small font-bold">Gender</label><select name="gender" class="form-control" required><option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></div>
                                <div class="col"><label class="small font-bold">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" required></div>
                                <div class="col"><label class="small font-bold">NIDA Number</label><input type="text" name="nida_number" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Education Level</label><input type="text" name="education_level" class="form-control" placeholder="e.g. Form 4"></div>
                                <div class="col"><label class="small font-bold">Course Applying</label><input type="text" name="course_applied" class="form-control" placeholder="e.g. Electrical"></div>
                                <div class="col"><label class="small font-bold">Phone Number</label><input type="text" name="phone_number" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Email Address</label><input type="email" name="email" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Admission ID</label><input type="text" name="admission_id" class="form-control" placeholder="Auto-generated if empty"></div>
                            </div>

                            <!-- 2. RESIDENCE (Grid 3) -->
                            <h6 class="border-bottom pb-2 mb-4" style="color: #0d6efd !important; font-weight: 600 !important; text-transform: uppercase;">
                                <i class="fas fa-map-marker-alt me-2"></i> Residence
                            </h6>
                            <div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
                                <div class="col"><label class="small font-bold">Region</label><input type="text" name="region" class="form-control"></div>
                                <div class="col"><label class="small font-bold">District</label><input type="text" name="district" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Ward</label><input type="text" name="ward" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Street</label><input type="text" name="street" class="form-control"></div>
                            </div>

                            <!-- 3. FATHER'S DETAILS (Grid 3) -->
                            <h6 class="text-dark uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1px; font-weight: 700 !important;">FATHER'S DETAILS</h6>
                            <div class="row row-cols-1 row-cols-md-3 g-3 mb-5 border-bottom pb-4">
                                <div class="col"><label class="small font-bold">First Name</label><input type="text" name="father_first_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Middle Name</label><input type="text" name="father_middle_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Last Name</label><input type="text" name="father_last_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Phone</label><input type="text" name="father_phone" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Region</label><input type="text" name="father_region" class="form-control"></div>
                                <div class="col"><label class="small font-bold">District</label><input type="text" name="father_district" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Ward</label><input type="text" name="father_ward" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Street</label><input type="text" name="father_street" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Address</label><input type="text" name="father_address" class="form-control"></div>
                            </div>

                            <!-- 4. MOTHER'S DETAILS (Grid 3) -->
                            <h6 class="text-dark uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1px; font-weight: 700 !important;">MOTHER'S DETAILS</h6>
                            <div class="row row-cols-1 row-cols-md-3 g-3 mb-5 border-bottom pb-4">
                                <div class="col"><label class="small font-bold">First Name</label><input type="text" name="mother_first_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Middle Name</label><input type="text" name="mother_middle_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Last Name</label><input type="text" name="mother_last_name" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Phone</label><input type="text" name="mother_phone" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Region</label><input type="text" name="mother_region" class="form-control"></div>
                                <div class="col"><label class="small font-bold">District</label><input type="text" name="mother_district" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Ward</label><input type="text" name="mother_ward" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Street</label><input type="text" name="mother_street" class="form-control"></div>
                                <div class="col"><label class="small font-bold">Address</label><input type="text" name="mother_address" class="form-control"></div>
                            </div>

                            <!-- 3.5 GUARDIAN'S DETAILS (Grid 3 - Kama ilivyo kwenye picha yako) -->
<h6 class="text-dark uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1px; font-weight: 700 !important; color: #000000 !important;">GUARDIAN'S DETAILS</h6>
<div class="row row-cols-1 row-cols-md-3 g-3 mb-5 border-bottom pb-4">
    <!-- Majina 3 ya Mlezi -->
    <div class="col">
        <label class="small font-bold">First Name</label>
        <input type="text" name="guardian_first_name" class="form-control" placeholder="Enter first name">
    </div>
    <div class="col">
        <label class="small font-bold">Middle Name</label>
        <input type="text" name="guardian_middle_name" class="form-control" placeholder="Enter middle name">
    </div>
    <div class="col">
        <label class="small font-bold">Last Name</label>
        <input type="text" name="guardian_last_name" class="form-control" placeholder="Enter last name">
    </div>
    
    <!-- Mahali anapoishi (Kama picha yako inavyoonyesha) -->
    <div class="col">
        <label class="small font-bold">Address</label>
        <input type="text" name="guardian_address" class="form-control" placeholder="P.O. Box / Postal Address">
    </div>
    <div class="col">
        <label class="small font-bold">Region</label>
        <input type="text" name="guardian_region" class="form-control" placeholder="Enter region">
    </div>
    <div class="col">
        <label class="small font-bold">District</label>
        <input type="text" name="guardian_district" class="form-control" placeholder="Enter district">
    </div>
    <div class="col">
        <label class="small font-bold">Ward</label>
        <input type="text" name="guardian_ward" class="form-control" placeholder="Enter ward">
    </div>
    <div class="col">
        <label class="small font-bold">Street</label>
        <input type="text" name="guardian_street" class="form-control" placeholder="Enter street">
    </div>
    <div class="col">
        <label class="small font-bold">Phone Number</label>
        <input type="text" name="guardian_phone" class="form-control" placeholder="Enter phone number">
    </div>
</div>

                            <!-- 5. SPONSOR DETAILS (Grid 3) -->
                            <!-- 5. SPONSOR / GUARANTOR INFORMATION (Grid 3 - Full 11 Fields) -->
<h6 class="border-bottom pb-2 mb-4" style="color: #0d6efd !important; font-weight: 600 !important; text-transform: uppercase;">
    <i class="fas fa-hand-holding-usd me-2"></i> Sponsor / Guarantor Information
</h6>
<div class="row row-cols-1 row-cols-md-3 g-3 mb-5">
    <!-- Mstari wa 1: Majina 3 -->
    <div class="col"><label class="small font-bold">First Name</label><input type="text" name="sponsor_first_name" class="form-control" placeholder="Enter first name"></div>
    <div class="col"><label class="small font-bold">Middle Name</label><input type="text" name="sponsor_middle_name" class="form-control" placeholder="Enter middle name"></div>
    <div class="col"><label class="small font-bold">Last Name</label><input type="text" name="sponsor_last_name" class="form-control" placeholder="Enter last name"></div>

    <!-- Mstari wa 2: Mahali -->
    <div class="col"><label class="small font-bold">Region</label><input type="text" name="sponsor_region" class="form-control" placeholder="Enter region"></div>
    <div class="col"><label class="small font-bold">District</label><input type="text" name="sponsor_district" class="form-control" placeholder="Enter district"></div>
    <div class="col"><label class="small font-bold">Ward</label><input type="text" name="sponsor_ward" class="form-control" placeholder="Enter ward"></div>

    <!-- Mstari wa 3: Kazi na Shirika -->
    <div class="col"><label class="small font-bold">Street</label><input type="text" name="sponsor_street" class="form-control" placeholder="Enter street"></div>
    <div class="col"><label class="small font-bold">Title / Position</label><input type="text" name="sponsor_title" class="form-control" placeholder="e.g. Director"></div>
    <div class="col"><label class="small font-bold">Organization</label><input type="text" name="sponsor_organization" class="form-control" placeholder="Company name"></div>

    <!-- Mstari wa 4: Mawasiliano -->
    <div class="col"><label class="small font-bold">Business / Occupation</label><input type="text" name="sponsor_business" class="form-control" placeholder="e.g. Farming"></div>
    <div class="col"><label class="small font-bold">Phone Number</label><input type="text" name="sponsor_phone" class="form-control" placeholder="Enter phone number"></div>
    <div class="col"><label class="small font-bold">Email Address</label><input type="email" name="sponsor_email" class="form-control" placeholder="Enter email address"></div>
</div>


                            <!-- 6. ATTACHMENTS (Premium Style) -->
                            <h6 class="border-bottom pb-2 mb-4" style="color: #0d6efd !important; font-weight: 600 !important; text-transform: uppercase;">
                                <i class="fas fa-paperclip me-2"></i> Documents & Attachments
                            </h6>
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <div class="p-4" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                        <div class="d-flex align-items-center mb-3">
                                            <div style="width: 45px; height: 45px; background: #e0e7ff; border-radius: 12px; display: flex; align-items: center; justify-content: center;" class="me-3"><i class="fas fa-user-tie" style="color: #4338ca;"></i></div>
                                            <div><h6 class="mb-0 font-bold text-dark uppercase" style="font-size: 0.85rem;">Passport Photo</h6><small class="text-muted" style="font-size: 0.7rem;">Allowed: JPG, PNG • Max 2MB</small></div>
                                        </div>
                                        <input type="file" name="passport_photo" id="passport_photo" class="d-none" onchange="document.getElementById('passport_name').innerHTML = this.files.name">
                                        <label for="passport_photo" class="btn btn-outline-primary w-100 py-2 rounded-pill font-black upload-btn-primary" style="border: 2px dashed #0d6efd; background: #f8faff;"><i class="fas fa-cloud-upload-alt me-2"></i> <span id="passport_name">Upload Photo</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-4" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                        <div class="d-flex align-items-center mb-3">
                                            <div style="width: 45px; height: 45px; background: #fee2e2; border-radius: 12px; display: flex; align-items: center; justify-content: center;" class="me-3"><i class="fas fa-file-medical text-danger"></i></div>
                                            <div><h6 class="mb-0 font-bold text-dark uppercase" style="font-size: 0.85rem;">Medical Form</h6><small class="text-muted" style="font-size: 0.7rem;">Allowed: PDF, JPG • Max 5MB</small></div>
                                        </div>
                                        <input type="file" name="medical_form" id="medical_form" class="d-none" onchange="document.getElementById('medical_name').innerHTML = this.files.name">
                                        <label for="medical_form" class="btn btn-outline-danger w-100 py-2 rounded-pill font-black upload-btn-danger" style="border: 2px dashed #dc3545; background: #fffafb;"><i class="fas fa-cloud-upload-alt me-2"></i> <span id="medical_name">Upload Medical Form</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow font-black">SUBMIT REGISTRATION</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
