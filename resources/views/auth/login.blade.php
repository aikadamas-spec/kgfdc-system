@extends('layouts.app')
@section('content')

<div style="
    width: 100%;
    max-width: 440px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12), 0 4px 16px rgba(30, 58, 138, 0.08);
    padding: 40px 40px 32px;
    font-family: 'Poppins', 'Segoe UI', sans-serif;
">

    {{-- Branding Header --}}
    <div style="text-align: center; margin-bottom: 32px;">
        <img src="{{ asset('assets/img/logo.jpg') }}"
             alt=""
             style="width: 150px; height: 150px; object-fit: contain; margin-bottom: 18px;">
        <h1 style="font-size: 1.35rem; font-weight: 800; color: #1e3a8a; margin: 0 0 4px;">
            Kigamboni FDC Dashboard
        </h1>
        <p style="font-size: 0.8rem; color: #94a3b8; margin: 0;">
            Sign in to your account to continue
        </p>
    </div>

    {{-- Login Form --}}
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group" style="margin-bottom: 18px;">
            <label style="font-size: 0.82rem; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">
                Email Address <span style="color: #ef4444;">*</span>
            </label>
            <div style="position: relative;">
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter your email"
                       class="form-control @error('email') is-invalid @enderror"
                       style="border-radius: 10px; padding: 10px 40px 10px 14px;
                              border: 1.5px solid #e2e8f0; font-size: 0.9rem;
                              transition: border-color 0.2s;"
                       autocomplete="email">
                <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;">
                    <i class="fas fa-envelope" style="font-size: 0.85rem;"></i>
                </span>
            </div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 18px;">
            <label style="font-size: 0.82rem; font-weight: 600; color: #374151; margin-bottom: 6px; display: block;">
                Password <span style="color: #ef4444;">*</span>
            </label>
            <div style="position: relative;">
                <input type="password"
                       name="password"
                       placeholder="Enter your password"
                       class="form-control pass-input @error('password') is-invalid @enderror"
                       style="border-radius: 10px; padding: 10px 40px 10px 14px;
                              border: 1.5px solid #e2e8f0; font-size: 0.9rem;
                              transition: border-color 0.2s;"
                       autocomplete="current-password">
                <span class="profile-views feather-eye toggle-password"
                      style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
                             color: #94a3b8; cursor: pointer;">
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px;">
            <label style="display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: #6b7280; cursor: pointer; margin: 0;">
                <input type="checkbox" name="remember" style="accent-color: #1e3a8a;">
                Remember me
            </label>
            <a href="#" style="font-size: 0.82rem; color: #2563eb; text-decoration: none; font-weight: 500;">
                Forgot Password?
            </a>
        </div>

        <button type="submit"
                class="btn btn-primary btn-block"
                style="border-radius: 10px; padding: 11px;
                       background: linear-gradient(135deg, #1e3a8a, #2563eb);
                       border: none; font-weight: 700; font-size: 0.95rem;
                       letter-spacing: 0.5px; box-shadow: 0 4px 14px rgba(37,99,235,0.35);
                       transition: opacity 0.2s;">
            <i class="fas fa-sign-in-alt me-2"></i> Sign In
        </button>
    </form>

    {{-- Footer --}}
    <p style="text-align: center; font-size: 0.78rem; color: #94a3b8; margin: 24px 0 0;">
        &copy; {{ date('Y') }} Kigamboni FDC. All rights reserved.
    </p>

</div>

@endsection
