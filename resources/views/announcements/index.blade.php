@extends('layouts.master')

@section('title', 'test')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @if($errors->any())
                @foreach($errors->all() as $key => $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endforeach
            @endif

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 d-flex justify-content-end my-3">
                        <button class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="fa fa-add me-3"></i>
                            <span class="w-100">@lang('public.add_admin')</span>
                        </button>
                    </div>
                    <div class="col-11">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            <div class="col">
                                <div class="card custom-dark-purple">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img src="{{ asset('assets/Images/current_tech_logo.png') }}" alt="Image" class="img-fluid w-100 h-100">
                                        </div>
                                        <div class="col-7">
                                            <div class="card-body">
                                                <h5 class="card-title">First Meeting</h5>
                                                <p class="card-text">@lang('public.posted_on') Card content goes here</p>
                                                <button class="btn btn-primary d-flex justify-content-center align-items-center w-100">@lang('public.view_details')
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="mt-2">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat the above three-card structure for each card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
