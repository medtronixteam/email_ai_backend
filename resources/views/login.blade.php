@extends('layouts.app')
@section('title','Login')
@section('content')

    <div class="auth-main" style="background-color: black ">
        <div class="auth-wrapper d-flex align-items-center justify-content-center">
            <div class="auth-form">
                <div class="card my-5 p-3 border-0" style=" background: linear-gradient(135deg, #1e90ff, #24A259);">
                    <div class="card-body">
                        <div class="user-icon mb-4 text-center">
                            <i class="fas fa-user-circle text-white" style="font-size: 80px; color: #007bff;"></i>
                        </div>

                        <h4 class="text-center text-white f-w-700 mb-3">Login here</h4>
                        @session('error')
                        <div class="alert alert-dark">
                            {{session('error')}}
                        </div>
                        @endsession
                        <form action="{{route('loginPost')}}" method="POST">
                            @csrf
                            <div class="mb-3"><input type="email" name="email" class="form-control rounded-pill" id="floatingInput"
                                placeholder="Enter email"></div>
                        <div class="mb-3"><input type="password" name="password" class="form-control rounded-pill" id="floatingInput1"
                                placeholder="Password"></div>
                        <div class="d-flex mt-1 justify-content-between align-items-center">
                            <div class="form-check text-white"><input class="form-check-input input-primary" type="checkbox"
                                    id="customCheckc1" checked=""> <label class="form-check-label"
                                    for="customCheckc1">Remember me?</label></div>
                            {{-- <h6 class="text-secondary f-w-400 mb-0"><a href="forgot-password-v1.html">Forgot
                                Password?</a></h6> --}}
                        </div>
                        <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Login</button></div>
                        </form>
                        <div class="d-flex justify-content-between align-items-end mt-4">
                            {{-- <h6 class="f-w-500 mb-0">Don't have an Account?</h6><a href="register-v1.html"
                            class="link-primary">Create Account</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
