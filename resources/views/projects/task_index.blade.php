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
                    <div class="col-11 d-flex justify-content-end mt-3">
                        <button class="btn btn-primary d-flex justify-content-center align-items-center me-3">
                            <i class="fa fa-add me-2"></i>
                            <span class="w-100">@lang('public.add_admin')</span>
                        </button>

                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
                            <label id="monthly" class="btn btn-outline-primary" for="btnradio1">@lang('public.all')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                            <label class="btn btn-outline-primary" for="btnradio2">@lang('public.planned')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                            <label class="btn btn-outline-primary" for="btnradio3">@lang('public.in_progress')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                            <label class="btn btn-outline-primary" for="btnradio4">@lang('public.completed')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio5">
                            <label class="btn btn-outline-primary" for="btnradio5">@lang('public.overdue')</label>
                        </div>
                    </div>
                    <div class="col-11 d-flex justify-content-start my-3">
                        <div class="row ">
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
                                            <a><i class="fa fa-info-circle text-primary fa-lg me-2"></i>@lang('public.planned')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-clock text-warning fa-lg me-2"></i>@lang('public.in_progress')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-check-circle text-success fa-lg me-2"></i>@lang('public.completed')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-exclamation-circle text-danger fa-lg me-2"></i>@lang('public.overdue')</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-secondary text-uppercase">
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.project_name')</th>
                                <th scope="col">@lang('public.project_category')</th>
                                <th scope="col">@lang('public.task_name')</th>
                                <th scope="col">@lang('public.created_by')</th>
                                <th scope="col">@lang('public.due_date')</th>
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
