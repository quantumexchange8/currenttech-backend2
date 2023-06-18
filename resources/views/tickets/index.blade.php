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
                        <form method="post" action="{{ route('tickets_index') }}">
                            @csrf
                            <div class="row">
                                <div class="col-2">
                                    <label for="employee_id" class="form-label">
                                        @lang('public.employee_id')
                                        <input type="text" class="form-control" id="employee_id" name="employee_id"  value="{{ @$search['employee_id'] }}">
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label for="employee_name" class="form-label">
                                        @lang('public.employee_name')
                                        <input type="text" class="form-control" id="employee_name" name="employee_name"  value="{{ @$search['employee_name'] }}">
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label for="start_date" class="form-label">
                                        @lang('public.from_date')
                                        <input type="date" class="form-control" id="start_date" name="start_date"  value="{{ @$search['start_date'] }}">
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label for="end_date" class="form-label">
                                        @lang('public.to_date')
                                        <input type="date" class="form-control" id="end_date" name="end_date"  value="{{ @$search['end_date'] }}">
                                    </label>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary mt-4 mx-0" type="submit" name="submit" value="search">@lang('public.search')</button>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-danger mt-4 mx-0" type="submit" name="submit" value="reset">@lang('public.clear')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-11">
                        @if($records->isNotEmpty())
                                <?php
                                $no = $records->firstItem();
                                ?>
                            <table class="table table-purple text-center">
                                <thead>
                                <tr class="text-secondary text-uppercase">
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('public.employee_id')</th>
                                    <th scope="col">@lang('public.name')</th>
                                    <th scope="col">@lang('public.created_date')</th>
                                    <th scope="col">@lang('public.feedback')</th>
                                    <th scope="col">@lang('public.attachment')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">{{$no}}</th>
                                        <td>{{$record->user->employee_id}}</td>
                                        <td>{{$record->user->name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}</td>
                                        <td>{{ $record->description }}</td>
                                        <td class="d-table-cell w-auto">
                                            @if($record->attachment)
                                                <a href="{{ asset('uploads/feedbacks/'.$record->attachment ) }}"
                                                   download> {{$record->attachment}}</a>
                                            @else
                                                -

                                            @endif
                                        </td>
                                    </tr>
                                        <?php
                                        $no++;
                                        ?>
                                @endforeach
                                </tbody>
                                <tr>
                                    <td colspan="10" class="pt-3 pb-0">
                                        {!! $records->links('pagination::bootstrap-4') !!}
                                    </td>
                                </tr>
                            </table>

                        @else
                            <caption class="text-secondary">
                                <div class="flex text-black text-small" role="alert">
                                    <span class="sr-only">@lang('public.info')</span>
                                    <div>
                                        <span class="font-medium">@lang('public.info') :</span>@lang('public.no_record')
                                    </div>
                                </div>
                            </caption>

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
