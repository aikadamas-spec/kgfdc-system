<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class StudentController extends Controller
{
    /** index page student list */
    public function student()
    {
        $studentList = Student::all();
        return view('student.student', compact('studentList'));
    }

    /** index page student grid */
    public function studentGrid()
    {
        $studentList = Student::all();
        return view('student.student-grid', compact('studentList'));
    }

    /** student add page */
    public function studentAdd()
    {
        return view('student.add-student');
    }
    
    /** Save Record */
    public function studentSave(Request $request)
    {
        $request->validate([
            // Student core
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'gender'        => 'required|not_in:0',
            'date_of_birth' => 'required|date',
            'phone_number'  => 'nullable|numeric|digits_between:8,15',
            'admission_id'  => 'nullable|string|unique:students,admission_id',
            'middle_name'        => 'nullable|string|max:255',
            'nida_number'        => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'region'             => 'nullable|string|max:255',
            'district'           => 'nullable|string|max:255',
            'ward'               => 'nullable|string|max:255',
            'street'             => 'nullable|string|max:255',
            'education_level'    => 'nullable|string|max:255',
            'course_applied'     => 'nullable|string|max:255',
            // Father
            'father_first_name'  => 'nullable|string|max:255',
            'father_middle_name' => 'nullable|string|max:255',
            'father_last_name'   => 'nullable|string|max:255',
            'father_phone'       => 'nullable|string|max:20',
            'father_region'      => 'nullable|string|max:255',
            'father_district'    => 'nullable|string|max:255',
            'father_ward'        => 'nullable|string|max:255',
            'father_street'      => 'nullable|string|max:255',
            'father_address'     => 'nullable|string|max:255',
            // Mother
            'mother_first_name'  => 'nullable|string|max:255',
            'mother_middle_name' => 'nullable|string|max:255',
            'mother_last_name'   => 'nullable|string|max:255',
            'mother_phone'       => 'nullable|string|max:20',
            'mother_region'      => 'nullable|string|max:255',
            'mother_district'    => 'nullable|string|max:255',
            'mother_ward'        => 'nullable|string|max:255',
            'mother_street'      => 'nullable|string|max:255',
            'mother_address'     => 'nullable|string|max:255',
            // Guardian
            'guardian_first_name'  => 'nullable|string|max:255',
            'guardian_middle_name' => 'nullable|string|max:255',
            'guardian_last_name'   => 'nullable|string|max:255',
            'guardian_address'     => 'nullable|string|max:255',
            'guardian_region'      => 'nullable|string|max:255',
            'guardian_district'    => 'nullable|string|max:255',
            'guardian_ward'        => 'nullable|string|max:255',
            'guardian_street'      => 'nullable|string|max:255',
            'guardian_phone'       => 'nullable|string|max:20',
            // Sponsor
            'sponsor_first_name'   => 'nullable|string|max:255',
            'sponsor_middle_name'  => 'nullable|string|max:255',
            'sponsor_last_name'    => 'nullable|string|max:255',
            'sponsor_region'       => 'nullable|string|max:255',
            'sponsor_district'     => 'nullable|string|max:255',
            'sponsor_ward'         => 'nullable|string|max:255',
            'sponsor_street'       => 'nullable|string|max:255',
            'sponsor_title'        => 'nullable|string|max:255',
            'sponsor_organization' => 'nullable|string|max:255',
            'sponsor_business'     => 'nullable|string|max:255',
            'sponsor_phone'        => 'nullable|string|max:20',
            'sponsor_email'        => 'nullable|email|max:255',
            // Files
            'passport_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'medical_form'   => 'nullable|file|mimes:pdf,jpg,jpeg|max:5120',
        ]);

        DB::beginTransaction();
        try {
            $uploadPath = null;
            if ($request->hasFile('upload')) {
                $filename = time() . '_' . $request->file('upload')->getClientOriginalName();
                $request->file('upload')->move(public_path('student-photos'), $filename);
                $uploadPath = 'student-photos/' . $filename;
            }

            $passportPhotoPath = null;
            if ($request->hasFile('passport_photo')) {
                $filename = time() . '_passport_' . $request->file('passport_photo')->getClientOriginalName();
                $request->file('passport_photo')->move(public_path('student-photos/passport'), $filename);
                $passportPhotoPath = 'student-photos/passport/' . $filename;
            }

            $medicalFormPath = null;
            if ($request->hasFile('medical_form')) {
                $filename = time() . '_medical_' . $request->file('medical_form')->getClientOriginalName();
                $request->file('medical_form')->move(public_path('student-photos/medical'), $filename);
                $medicalFormPath = 'student-photos/medical/' . $filename;
            }

            Student::create([
                // Student core
                'first_name'     => $request->first_name,
                'middle_name'    => $request->middle_name,
                'last_name'      => $request->last_name,
                'gender'         => $request->gender,
                'date_of_birth'  => $request->date_of_birth,
                'phone_number'   => $request->phone_number,
                'admission_id'   => $request->admission_id,
                'nida_number'    => $request->nida_number,
                'email'          => $request->email,
                'region'         => $request->region,
                'district'       => $request->district,
                'ward'           => $request->ward,
                'street'         => $request->street,
                'education_level'=> $request->education_level,
                'course_applied' => $request->course_applied,
                'upload'         => $uploadPath,
                'passport_photo' => $passportPhotoPath,
                'medical_form'   => $medicalFormPath,
                // Father
                'father_first_name'  => $request->father_first_name,
                'father_middle_name' => $request->father_middle_name,
                'father_last_name'   => $request->father_last_name,
                'father_phone'       => $request->father_phone,
                'father_region'      => $request->father_region,
                'father_district'    => $request->father_district,
                'father_ward'        => $request->father_ward,
                'father_street'      => $request->father_street,
                'father_address'     => $request->father_address,
                // Mother
                'mother_first_name'  => $request->mother_first_name,
                'mother_middle_name' => $request->mother_middle_name,
                'mother_last_name'   => $request->mother_last_name,
                'mother_phone'       => $request->mother_phone,
                'mother_region'      => $request->mother_region,
                'mother_district'    => $request->mother_district,
                'mother_ward'        => $request->mother_ward,
                'mother_street'      => $request->mother_street,
                'mother_address'     => $request->mother_address,
                // Guardian
                'guardian_first_name'  => $request->guardian_first_name,
                'guardian_middle_name' => $request->guardian_middle_name,
                'guardian_last_name'   => $request->guardian_last_name,
                'guardian_address'     => $request->guardian_address,
                'guardian_region'      => $request->guardian_region,
                'guardian_district'    => $request->guardian_district,
                'guardian_ward'        => $request->guardian_ward,
                'guardian_street'      => $request->guardian_street,
                'guardian_phone'       => $request->guardian_phone,
                // Sponsor
                'sponsor_first_name'   => $request->sponsor_first_name,
                'sponsor_middle_name'  => $request->sponsor_middle_name,
                'sponsor_last_name'    => $request->sponsor_last_name,
                'sponsor_region'       => $request->sponsor_region,
                'sponsor_district'     => $request->sponsor_district,
                'sponsor_ward'         => $request->sponsor_ward,
                'sponsor_street'       => $request->sponsor_street,
                'sponsor_title'        => $request->sponsor_title,
                'sponsor_organization' => $request->sponsor_organization,
                'sponsor_business'     => $request->sponsor_business,
                'sponsor_phone'        => $request->sponsor_phone,
                'sponsor_email'        => $request->sponsor_email,
            ]);

            DB::commit();

            // Auto-create login account for the student
            if ($request->email) {
                User::firstOrCreate(
                    ['email' => $request->email],
                    [
                        'name'      => $request->first_name . ' ' . $request->last_name,
                        'email'     => $request->email,
                        'role_name' => 'Student',
                        'password'  => Hash::make('12345678'),
                        'status'    => 'Active',
                    ]
                );
            }

            return redirect()->back()->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Failed: ' . $e->getMessage());
        }
    }

    /** student profile page */
    public function studentProfile($id)
    {
        $student = Student::findOrFail($id);
        return view('student.student-profile', compact('student'));
    }

    /** update student status (Approve / Reject) */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected,Pending',
        ]);

        Student::findOrFail($id)->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Student status updated to ' . $request->status . '.');
    }

    /** student edit page */
    public function studentEdit($id)
    {
        $studentEdit = Student::findOrFail($id);
        return view('student.edit-student', compact('studentEdit'));
    }

    /** update student record - FULL UPDATE FOR 52 FIELDS */
    public function studentUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $student = Student::findOrFail($request->id);

            $uploadPath = $student->upload;
            if ($request->hasFile('upload')) {
                $filename = time() . '_' . $request->file('upload')->getClientOriginalName();
                $request->file('upload')->move(public_path('student-photos'), $filename);
                $uploadPath = 'student-photos/' . $filename;
            }

            $passportPath = $student->passport_photo;
            if ($request->hasFile('passport_photo')) {
                $filename = time() . '_passport_' . $request->file('passport_photo')->getClientOriginalName();
                $request->file('passport_photo')->move(public_path('student-photos/passport'), $filename);
                $passportPath = 'student-photos/passport/' . $filename;
            }

            $data = $request->all();
            $data['upload'] = $uploadPath;
            $data['passport_photo'] = $passportPath;

            $student->update($data);

            DB::commit();
            return redirect()->route('student/list')->with('success', 'Student information updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update record: ' . $e->getMessage());
        }
    }

    /** delete record */
    public function studentDelete(Request $request)
    {
        Student::destroy($request->id);
        return redirect()->back()->with('success', 'Deleted successfully!');
    }
}
