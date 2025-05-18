@extends('layout')

@section('title', 'Register')

@section('content')
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg rounded-4 p-4 p-md-5" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Create an Account</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control rounded-3" id="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control rounded-3" id="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control rounded-3" id="password" placeholder="Enter your password" required>
            </div>

            <div class="form-group mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-3" id="password_confirmation" placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-3">Register</button>
        </form>

        <div class="text-center mt-4">
            <small>
                Already have an account?
                <a href="{{ route('login.form') }}" class="text-decoration-none fw-semibold">Login here</a>
            </small>
        </div>
    </div>
</div>
@endsection
