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
                    <div class="col-11 d-flex justify-content-start my-3">
                        <div class="row">
                            <div class="col">
                                <label for="employee_id" class="form-label">
                                    @lang('public.employee_id')
                                    <input type="text" class="form-control" id="employee_id">
                                </label>
                            </div>
                            <div class="col">
                                <label for="employee_name" class="form-label">
                                    @lang('public.employee_name')
                                    <input type="text" class="form-control" id="employee_name">
                                </label>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary mt-4" type="button">@lang('public.search')</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="container">
                            <div class="row">
                                @foreach($users as $user)
                                    <div class="col-md-6">
                                        <div class="card custom-dark-purple  p-3">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="rounded-circle border border-dark"
                                                             style="width: 100%; height: 100%; overflow: hidden;">
                                                            <img src="{{ asset('assets/Images/profile-pic-test.jpg')}}"
                                                                 style="width: 100%; height: 100%; object-fit: cover;"
                                                                 alt="">
                                                        </div>
                                                        <div class="row mt-3 align-items-center text-center">

                                                            <div class="col">
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <i class="fa fa-star"
                                                                       style="color: rgba(248, 231, 28, 1)"></i>
                                                                    <p class="mt-auto">lvl.{{ $user->year_end_bonus_level }}</p>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="d-flex h-100">
                                                        <div class="vr"></div>
                                                    </div>
                                                </div>
                                                <div class="col-7 ps-0">
                                                    <h5 class="card-title" href="#">
                                                        {{ $user->name }}
                                                    </h5>
                                                    <div class="my-2 me-3">
                                                        <a class="bg-success text-decoration-none text-dark px-2 rounded">
                                                            @switch($user->employment_type)
                                                                @case(\App\Models\User::EMPLOYMENT_TYPE_PERMENANT)
                                                                    @lang('public.permanent')
                                                                    @break
                                                                @case(\App\Models\User::EMPLOYMENT_TYPE_PROBATION)
                                                                    @lang('public.probation')
                                                                    @break
                                                                @case(\App\Models\User::EMPLOYMENT_TYPE_PARTIME)
                                                                    @lang('public.part_timer')
                                                                    @break
                                                                @case(\App\Models\User::EMPLOYMENT_TYPE_FREELANCER)
                                                                    @lang('public.freelancer')
                                                                    @break
                                                                @case(\App\Models\User::EMPLOYMENT_TYPE_INTERN)
                                                                    @lang('public.internship')
                                                                    @break
                                                                @default
                                                                    @lang('public.permanent')
                                                            @endswitch
                                                        </a>
                                                    </div>
                                                    <div class="row justify-content-between" style="font-size: 11px">
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 " data-progress="96" style="background: conic-gradient(rgba(53, 57, 114, 1) 96%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.attendance')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 " data-progress="{{$user->punctuality}}" style="background: conic-gradient(rgba(53, 57, 114, 1) {{$user->punctuality}}%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.puntuality')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 " data-progress="96" style="background: conic-gradient(rgba(53, 57, 114, 1) 96%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.complete_task')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 " data-progress="{{$user->attitude}}" style="background: conic-gradient(rgba(53, 57, 114, 1) {{$user->attitude}}%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.attitude')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col">
                                                            <a href="{{ route('employee_detail', ['id' => $user->id]) }}" class="btn btn-primary mt-2 h-100 w-100">
                                                                <i class="fa fa-address-card"></i>
                                                                @lang('public.view_profile')
                                                            </a>
                                                        </div>
                                                        <div class="col">
                                                            <button class="btn btn-primary mt-2 h-100 w-100" type="button">
                                                                <i class="fa fa-pencil-square"></i>
                                                                @lang('public.update_attitude')
                                                            </button>
                                                        </div>
                                                        <div class="col">
                                                            <button class="btn btn-danger mt-2 h-100 w-100" type="button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
