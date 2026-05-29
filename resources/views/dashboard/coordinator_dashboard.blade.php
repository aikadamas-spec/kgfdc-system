@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome, {{ Session::get('name') }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Coordinator Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top Row: Summary Cards --}}
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Students</h6>
                                <h3>{{ $totalStudents ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Students">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Teachers</h6>
                                <h3>{{ $totalTeachers ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/teacher-icon-01.svg') }}" alt="Teachers">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Subjects</h6>
                                <h3>{{ $totalSubjects ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/teacher-icon-02.svg') }}" alt="Subjects">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Departments</h6>
                                <h3>{{ $totalDepartments ?? '—' }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ URL::to('assets/img/icons/dash-icon-03.svg') }}" alt="Departments">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Middle Row: Teaching Activity (left) + Calendar & Events (right) --}}
        <div class="row">

            {{-- Left: Upcoming Lessons + Teaching Activity Chart --}}
            <div class="col-12 col-lg-12 col-xl-8">

                {{-- Upcoming Lessons --}}
                <div class="card flex-fill comman-shadow mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Upcoming Lessons</h5>
                            </div>
                            <div class="col-6">
                                <span class="float-end view-link"><a href="#">View All Courses</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 pb-3">
                        <div class="table-responsive lesson">
                            <table class="table table-center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="date">
                                                <b>Lesson 30</b>
                                                <p>3.1 Introduction to Topic</p>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>Sep 5, 2022</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>09:00 - 10:00 am</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="lesson-confirm"><a href="#">Confirmed</a></div>
                                            <button type="button" class="btn btn-info">Reschedule</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="date">
                                                <b>Lesson 31</b>
                                                <p>3.2 Advanced Concepts</p>
                                                <ul class="teacher-date-list">
                                                    <li><i class="fas fa-calendar-alt me-2"></i>Sep 6, 2022</li>
                                                    <li>|</li>
                                                    <li><i class="fas fa-clock me-2"></i>10:00 - 11:00 am</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="lesson-confirm"><a href="#">Confirmed</a></div>
                                            <button type="button" class="btn btn-info">Reschedule</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Teaching Activity Chart --}}
                <div class="card flex-fill comman-shadow">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Teaching Activity</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Teachers</li>
                                    <li><span class="circle-green"></span>Students</li>
                                    <li class="star-menus">
                                        <a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="school-area"></div>
                    </div>
                </div>

            </div>

            {{-- Right: Calendar + Upcoming Events --}}
            <div class="col-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-body">
                        <div id="calendar-doctor" class="calendar-container"></div>
                        <div class="calendar-info calendar-info1">
                            <div class="up-come-header">
                                <h2>Upcoming Events</h2>
                                <span><a href="javascript:;"><i class="feather-plus"></i></a></span>
                            </div>

                            @php
                                $nextMonday    = \Carbon\Carbon::now()->next('Monday');
                                $nextWednesday = \Carbon\Carbon::now()->next('Wednesday');
                                $nextFriday    = \Carbon\Carbon::now()->next('Friday');
                                $nextSaturday  = \Carbon\Carbon::now()->next('Saturday');
                            @endphp

                            {{-- Event 1: Semester Examination --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextMonday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>09:00 AM</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Semester Examination</h4>
                                        <h5>All students must attend</h5>
                                    </div>
                                    <span>09:00 AM - 12:00 PM</span>
                                </div>
                            </div>

                            {{-- Event 2: Practical Workshop Assessment --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextWednesday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>10:30 AM</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Practical Workshop Assessment</h4>
                                        <h5>Bring all required materials</h5>
                                    </div>
                                    <span>10:30 AM - 01:00 PM</span>
                                </div>
                            </div>

                            {{-- Event 3: Staff Meeting --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextFriday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>02:00 PM</p>
                                <div class="calendar-box break-bg">
                                    <div class="calandar-event-name">
                                        <h4>Staff Meeting: Term Review</h4>
                                        <h5>All teaching staff required</h5>
                                    </div>
                                    <span>02:00 - 04:00 PM</span>
                                </div>
                            </div>

                            {{-- Event 4: Community Outreach --}}
                            <div class="upcome-event-date">
                                <h3>{{ $nextSaturday->format('d M') }}</h3>
                                <span><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            <div class="calendar-details">
                                <p>08:00 AM</p>
                                <div class="calendar-box normal-bg">
                                    <div class="calandar-event-name">
                                        <h4>Community Outreach Program</h4>
                                        <h5>Kigamboni Community Centre</h5>
                                    </div>
                                    <span>08:00 AM - 12:00 PM</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
