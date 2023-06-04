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
                    <div class="col-7 d-flex flex-column justify-content-start mt-3">
                        <div class="row align-items-center">
                            <h2>Project abc</h2>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <a class="text-secondary">10 tasks opened | 5 tasks completed</a>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-end my-3">
                        <div class="ms-auto">
                            <button class="btn btn-primary">
                                <i class="fa fa-add me-2"></i>
                                <span class="w-100">@lang('public.add_admin')</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-11 ">
                        <div class="row g-4 align-items-stretch">
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>Project Description</h2>
                                    <p class="text-secondary">asdas asd as asd sa dsa d asd sad sad sa dsa dsa das dsa
                                        ds ad sad sad sad sa dsa
                                        dsa d sad sa dsa dsa d asd sad as dsa dsa ds ad sad sad</p>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-column custom-dark-purple h-100  p-3">
                                    <h2>Project Information</h2>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="file-icon text-center">
                                                <img src="{{ asset('assets/Images/file_image.png') }}" alt="File Icon 1"
                                                     class="img-fluid">
                                                <p class="mt-2">File 1</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="file-icon text-center">
                                                <img src="{{ asset('assets/Images/file_image.png') }}" alt="File Icon 2"
                                                     class="img-fluid">
                                                <p class="mt-2">File 2</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="file-icon text-center">
                                                <img src="{{ asset('assets/Images/file_image.png') }}" alt="File Icon 3"
                                                     class="img-fluid">
                                                <p class="mt-2">File 3</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="file-icon text-center">
                                                <img src="{{ asset('assets/Images/file_image.png') }}" alt="File Icon 4"
                                                     class="img-fluid">
                                                <p class="mt-2">File 4</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row g-4 align-items-stretch mt-3">
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>Project Details</h2>
                                    <div class="col text-secondary">
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.created_on')</div>
                                                <div>11 Oct 2022</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.created_by')</div>
                                                <div>11 Oct 2022</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.project_start_date')</div>
                                                <div>11 Oct 2022</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.project_end_date')</div>
                                                <div>11 Oct 2022</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.priority')</div>
                                                <div>11 Oct 2022</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.visual_progress')</div>
                                                <div>15%</div>
                                            </div>
                                            <div class="row g-0 mt-2">
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 15%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.actual_progress')</div>
                                                <div>15%</div>
                                            </div>
                                            <div class="row g-0 mt-2">
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 15%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>Uploaded Files</h2>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row g-4 align-items-stretch">
                                                    <div class="col-auto d-flex align-items-center">
                                                        <i class="fa fa-file-text" style="height: 75%;"></i>
                                                    </div>
                                                    <div class="col text-secondary ms-5" >
                                                        <div class="row">
                                                            <a href="#" class="text-start">File name</a>
                                                            <div class="text-start" style="font-size: 11px;">@lang('public.uploaded_by') <span class="text-warning pe-2">zy </span>11/11/2023 11:11pm</div>
                                                            <div class="text-start" style="font-size: 11px;">@lang('public.file_size'): 3.1mb</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>Task Assigned</h2>
                                    <div class="row">
                                        <div class="col text-secondary">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        Default checkbox
                                                    </label>
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        Default checkbox 2
                                                    </label>
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                </div>
                                            </div>
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
