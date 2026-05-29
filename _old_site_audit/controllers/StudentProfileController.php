<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function create()
    {
        return view('lms.registration_form');
    }

    public function store(Request $request)
    {
        // 1. Validate all mandatory fields
        $request->validate([
            'first_name'    => 'required|string|max:255',
            'middle_name'   => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'gender'        => 'required|in:Me,Ke',
            'birth_date'    => 'required|date',
            'phone_number'  => 'required|string|max:20',
            'region'        => 'required|string|max:255',
            'district'      => 'required|string|max:255',
            'course'        => 'required|string|max:255',
            'passport_photo' => 'required|file|image|max:2048',
            'medical_form'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // 2. Handle passport photo upload
        $passportPath = $request->file('passport_photo')->store('passports', 'public');

        // 3. Handle medical form upload
        $medicalPath = $request->file('medical_form')->store('medical_records', 'public');

        // 4. Build data array — exclude raw file inputs and the 'course' alias
        $data = $request->except(['passport_photo', 'medical_form', 'course']);

        // 5. Map course select → course_applied column, attach file paths and user
        $data['user_id']       = auth()->id();
        $data['course_applied'] = $request->input('course');
        $data['passport_photo'] = $passportPath;
        $data['medical_form']   = $medicalPath;

        StudentProfile::create($data);

        return redirect()->route('dashboard')->with('success', 'Hongera! Usajili na nyaraka zimehifadhiwa.');
    }
}
