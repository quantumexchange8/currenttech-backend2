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
                        <h5 class="pb-2 login">Reset Password</h5>
                        <form method="post" action="{{ route('post_reset_password') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="login-form d-flex flex-column d-flex align-items-center">
                                <div class="form-group w-100">
                                    <label for="password" class="form-label">New Password
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Employee Password"
                                               id="password"
                                               aria-label="password" name="password">
                                        <span class="input-group-text pt-1 text-white fa fa-eye"
                                              id="pass_button"></span>
                                    </div>
                                </div>
                                @error('password')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror

                                <div class="form-group w-100">
                                    <label for="password" class="form-label">Repeat Password
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Employee Password"
                                               id="password_2"
                                               aria-label="password" name="password_confirmation">
                                        <span class="input-group-text pt-1 text-white fa fa-eye"
                                              id="pass_button_confirm"></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn mt-4 bg-dark-blue text-light">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
