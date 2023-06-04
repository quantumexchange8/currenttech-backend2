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
                            <span class="w-100">@lang('public.add_department')</span>
                        </button>
                    </div>
                    <div class="col-11">

                        <table class="table table-purple text-center">
                            <caption class="text-secondary">Page 1 of 5</caption>
                            <thead>
                            <tr class="text-secondary  text-uppercase">
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.employee_id')</th>
                                <th scope="col">@lang('public.department_head')</th>
                                <th scope="col">@lang('public.department_name')</th>
                                <th scope="col">@lang('public.no_of_employee')</th>
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
