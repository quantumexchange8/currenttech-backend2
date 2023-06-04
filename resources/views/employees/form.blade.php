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

{{--            <div class="container">--}}
{{--                <div class="row justify-content-center mt-3">--}}
{{--                    <div class="col-11">--}}
{{--                        <div class="row custom-dark-purple mt-3">--}}
{{--                            <h4 class="py-3">@lang('public.personal_information')</h4>--}}
{{--                                <div class="col-6">--}}
{{--                                    <div class="form-group w-100 mt-3">--}}
{{--                                        <label for="inputID" class="form-label">Employee ID</label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::select('size', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'text-secondary bg-primary']) !!}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group w-100 mt-3">--}}
{{--                                        <label for="inputID" class="form-label">Employee ID</label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input type="text" class="form-control" placeholder="Employee ID"--}}
{{--                                                   aria-label="Recipient's username" aria-describedby="basic-addon2">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="col-6">--}}
{{--                                    <div class="form-group w-100">--}}
{{--                                        <label for="inputID" class="form-label">Employee ID</label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input type="text" class="form-control" placeholder="Employee ID"--}}
{{--                                                   aria-label="Recipient's username" aria-describedby="basic-addon2">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
