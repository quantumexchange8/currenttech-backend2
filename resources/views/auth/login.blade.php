@extends('layouts.master-without-nav')

@section('title')
    Login
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg d-none d-sm-block">
                <div class="login-page-left d-flex align-items-center justify-content-center overflow-hidden ">
                    <img src="{{ asset('assets/Images/LoginPage.png') }}" alt="" class="w-100 vh-100">
                </div>
            </div>
            <div class="col-lg align-self-center d-flex flex-column justify-content-center align-items-center">
                <div class="login-page-right py-5" style="background-color: rgba(19, 17, 28, 1)">
                    <div class="login-page-details d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('assets/Images/CT(Logo).png')}}" alt="background" class="w-50">
                        <h4 class="pt-4">ADMIN PORTAL</h4>
                        <h5 class="pb-2 login">Log In</h5>
                        <form method="POST" action="{{ route('post_login') }}" class="login-form">
                            @csrf
                            <div class="login-form d-flex flex-column d-flex align-items-center">
                                <div class="form-group w-100">
                                    <label for="inputID" class="form-label">Employee ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Employee ID" id="username" name="username" required="required"
                                               aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ old('username') }}">
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <label for="password" class="form-label d-flex justify-content-between">
                                        Password
                                        <a href="{{ url('forgot-password') }}" class="text-secondary pt-2" style="font-size: 11px;">Forgot Password?</a>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Employee Password" id="password" name="password" required="required"
                                               aria-label="password">
                                        <span class="input-group-text pt-1 text-white fa fa-eye" id="pass_button"></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn mt-4 bg-dark-blue text-light">Click to
                                    Login</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
