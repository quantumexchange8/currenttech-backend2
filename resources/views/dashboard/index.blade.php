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
                        <div class="col-11 d-flex  justify-content-evenly my-3">
                            <div class="row w-100">
                                <div class="col">
                                    <div class="border border-3 p-3 d-flex align-items-center text-center">
                                        <div class="rounded-circle bg-dark-blue text-white mx-4 d-flex justify-content-center align-items-center " style="width: 60px; height: 60px;">
                                            <i class="fa fa-eye fa-2x "></i>
                                        </div>
                                        <div class="text-center">
                                            <h2>3</h2>
                                            <h5 >@lang('public.leave_request')</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border border-3 p-3 d-flex align-items-center text-center">
                                        <div class="rounded-circle bg-dark-blue text-white mx-4 d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <i class="fa fa-bars fa-2x"></i>
                                        </div>
                                        <div class="text-center">
                                            <h2>3</h2>
                                            <h5 >@lang('public.claim_request')</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border border-3 p-3 d-flex align-items-center text-center">
                                        <div class="rounded-circle bg-dark-blue text-white mx-4 d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <i class="fa fa-ticket fa-2x"></i>
                                        </div>
                                        <div class="text-center">
                                            <h2>3</h2>
                                            <h5 >@lang('public.employee_ticket')</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <label for="start_date" class="form-label">
                                    @lang('public.from_date')
                                    <input type="date" class="form-control" id="start_date">
                                </label>
                            </div>
                            <div class="col">
                                <label for="end_date" class="form-label">
                                    @lang('public.to_date')
                                    <input type="date" class="form-control" id="end_date">
                                </label>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary mt-4" type="button">@lang('public.search')</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-11">

                        <table class="table table-purple text-center">
                            <caption class="text-secondary">Page 1 of 5</caption>
                            <thead>
                            <tr>
                                <td colspan="10">
                                    <div class="row justify-content-start pt-1 pb-2">
                                        <div class="col-auto">
                                            <a><i class="fa fa-times-circle text-danger fa-lg me-2"></i>@lang('public.absent')</a>
                                        </div>
                                        <div class="col-auto">
                                                <a><i class="fa fa-check-circle text-success fa-lg me-2"></i>@lang('public.present')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-clock text-warning fa-lg me-2"></i>@lang('public.late')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-minus-circle text-primary fa-lg me-2"></i>@lang('public.on_leave')</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-secondary text-uppercase">
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.name')</th>
                                <th scope="col">@lang('public.date')</th>
                                <th scope="col">@lang('public.punch_in_time')</th>
                                <th scope="col">@lang('public.punch_out_time')</th>
                                <th scope="col">@lang('public.lunch_time')</th>
                                <th scope="col">@lang('public.rest_time')</th>
                                <th scope="col">@lang('public.overtime')</th>
                                <th scope="col">@lang('public.status')</th>
                                <th scope="col">@lang('public.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td class="d-table-cell w-auto">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Button Group">
                                        <button type="button" class="btn">
                                            <i class="fa fa-pencil text-success"></i>
                                        </button>
                                        <button type="button" class="btn me-1">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                        <button type="button" class="btn">
                                            <i class="fa fa-eye" style="color: rgba(53, 57, 114, 1)"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
