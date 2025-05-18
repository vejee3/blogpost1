@extends('layout')

@section('content')
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="row bg-white shadow-lg rounded-5 overflow-hidden" style="width: 900px; max-width: 100%; padding: 0;">
       
        <div class="col-md-6 d-none d-md-flex bg-primary text-white align-items-center justify-content-center flex-column p-4">
    <img src="{{ asset('images/vj.jpg') }}"
         alt="App Logo"
         class="rounded-4 shadow-lg mb-3"
         style="max-width: 240px;">
    <h3 class="mt-3">Welcome Back!</h3>
    <p class="text-center">Log in to access your dashboard</p>
    </div>

        <div class="col-md-6 p-5">
            <h2 class="text-center mb-4">Login</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control rounded-3" id="email" placeholder="Enter email" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control rounded-3" id="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-3">Login</button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('register.form') }}">Don't have an account? <strong>Register here</strong></a>
            </div>
        </div>
    </div>
</div>

@endsection
