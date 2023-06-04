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
                        <button class="btn btn-primary d-flex justify-content-center align-items-center me-3">
                            <i class="fa fa-add me-2"></i>
                            <span class="w-100">@lang('public.add_admin')</span>
                        </button>

                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
                            <label id="monthly" class="btn btn-outline-primary" for="btnradio1">@lang('public.all')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                            <label class="btn btn-outline-primary" for="btnradio3">@lang('public.in_progress')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                            <label class="btn btn-outline-primary" for="btnradio4">@lang('public.completed')</label>

                        </div>
                    </div>
                    <div class="col-11">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            <div class="col">
                                <div class="card custom-dark-purple  p-3">
                                    <div class="row g-0">
                                        <div class="col-11">
                                            <h5 class="card-title" href="#">
                                                <a href="{{ route('project_details', "1") }}" class="text-white">Project abc</a>
                                            </h5>

                                        </div>
                                        <div class="col-1">
                                            <div class="mt-2">
                                                <a class="nav-link" id="notificationsDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="text-white fas fa-ellipsis-v"></i> </a>

                                                <ul class="dropdown-menu dropdown-menu-end custom-dark-purple text-white" aria-labelledby="notificationsDropdown">
                                                    <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                    <li><a class="dropdown-item text-danger" href="#!">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 mt-2">
                                        <div class="col-6">

                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <div class="mt-2 me-3">
                                                <a class="bg-success text-decoration-none text-dark px-2 rounded">New</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 mt-4">
                                        <div class="col-6 d-flex justify-content-start">
                                            <a class="text-decoration-none text-white">
                                                <i class="fa fa-hourglass me-2"></i>
                                                2 months</a>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <a class="text-decoration-none text-white">
                                                <i class="fa fa-spinner me-2"></i>
                                                level 4- very urgent</a>
                                        </div>
                                    </div>
                                    <div class="row g-0 mt-2">
                                        <div class="col-6 d-flex justify-content-start">
                                            <a class="text-decoration-none text-white">
                                                <i class="fa fa-file-text me-2"></i>
                                                5 attachments</a>
                                        </div>
                                        <div class="col-6 d-flex justify-content-start">
                                            <a class="text-decoration-none text-white">
                                                <i class="fa fa-tasks me-2"></i>
                                                0 tasks</a>
                                        </div>
                                    </div>
                                    <div class="row g-0 mt-4">
                                        <div class="col-6">
                                            <a class="text-decoration-none text-white">Progress: 0%</a>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <div class="mt-2 me-3">
                                                <a class="bg-pink text-decoration-none text-dark px-2 rounded">60 days left</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-0 mt-2">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning  w-50" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
