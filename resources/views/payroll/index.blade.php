@extends('layouts.master')

@section('title', $title)

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
                            <tr class="text-secondary text-uppercase">
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.employee_id')</th>
                                <th scope="col">@lang('public.name')</th>
                                <th scope="col">@lang('public.employment_type')</th>
                                <th scope="col">@lang('public.designation')</th>
                                <th scope="col">@lang('public.months')</th>
                                <th scope="col">@lang('public.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
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
