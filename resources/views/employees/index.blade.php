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
                                    <div class="col-md-6 mt-3">
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
                                                                    <p class="mt-auto">
                                                                        lvl.{{ $user->year_end_bonus_level }}</p>
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
                                                                <div class="progress-bar2 " data-progress="96"
                                                                     style="background: conic-gradient(rgba(53, 57, 114, 1) 96%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.attendance')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 "
                                                                     data-progress="{{$user->punctuality}}"
                                                                     style="background: conic-gradient(rgba(53, 57, 114, 1) {{$user->punctuality}}%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.punctuality')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 " data-progress="96"
                                                                     style="background: conic-gradient(rgba(53, 57, 114, 1) 96%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.complete_task')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="progress-bar2 "
                                                                     data-progress="{{$user->attitude}}"
                                                                     style="background: conic-gradient(rgba(53, 57, 114, 1) {{$user->attitude}}%, rgba(19, 17, 28, 1) 0);">
                                                                </div>
                                                                <p class="mt-auto pt-2">@lang('public.attitude')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col">
                                                            <a href="{{ route('employee_detail', ['id' => $user->id]) }}"
                                                               class="btn btn-primary mt-2 h-100 w-100">
                                                                <i class="fa fa-address-card"></i>
                                                                @lang('public.view_profile')
                                                            </a>
                                                        </div>
                                                        <div class="col">

                                                            <button type="button" id="{{$user->id}}"
                                                                    class="btn btn-primary d-flex justify-content-center align-items-center mt-2 h-100 w-100 submit_button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal">
                                                                <i class="fa fa-add me-3"></i>
                                                                <span
                                                                    class="w-100">@lang('public.update_attitude')</span>
                                                            </button>
                                                        </div>
                                                        <div class="col">
                                                            <button class="btn btn-danger mt-2 h-100 w-100"
                                                                    type="button">
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
    {{--    modal --}}
    <form method="post" action="{{ route('update_attitude_punctuality') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalLabel">                    @lang('public.add_department')
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                        <div class="row">
                            <div class="col">
                                <label for="attitude" class="form-label">@lang('public.attitude')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="attitude" name="attitude"
                                           required="required"
                                           aria-label="attitude" aria-describedby="basic-addon2"
                                           value="{{ @$input->attitude }}">
                                </div>
                                @error('attitude')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="punctuality" class="form-label">@lang('public.punctuality')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="punctuality" name="punctuality"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->punctuality }}">
                                </div>
                                @error('punctuality')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('public.update')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.submit_button').on('click', function() {
                let id = $(this).attr('id');

                $.ajax({
                    url: '{{ route("get_user_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        $(".modal-body #id").val(response.id);
                        $(".modal-body #attitude").val(response.attitude);
                        $(".modal-body #punctuality").val(response.punctuality);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the request
                        console.error(error);
                    }
                });

            });



            // Trigger the modal with a button click or any other event
            @if($errors->any())
            $('#exampleModal').modal('show');
            @endif
        });
    </script>
@endsection
