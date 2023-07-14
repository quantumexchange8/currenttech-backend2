@extends('layouts.master')

@section('title') {{ $title }} @endsection

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
                <div class="row justify-content-center mt-3">
                    <div class="col-11">
                        <div class="row custom-dark-purple">
                            <div class="col-3">
                                <div class="d-flex flex-column align-items-center p-3">
                                    <div class="rounded-circle border border-dark"
                                         style=" width: 150px; height: 150px; overflow: hidden;">
                                        <img src="{{ asset('assets/Images/profile-pic-test.jpg')}}"
                                             style="width: 150px; height: 150px; object-fit: cover;"
                                             alt="">
                                    </div>
                                    <div class="row mt-3 align-items-center text-center">
                                        <a>@lang('public.employee_id'): {{ $user->employee_id }}</a>
                                        <a>{{ $user->designation }}</a>
                                    </div>


                                </div>
                            </div>
                            <div class="col-1">
                                <div class="d-flex h-100">
                                    <div class="vr"></div>
                                </div>
                            </div>
                            <div class="col-7 py-3">
                                <h5>
                                    {{ $user->name }}
                                </h5>
                                <div class="my-2 me-3">
                                    <a class="bg-success text-decoration-none text-dark px-2 py-1 rounded"> {{ $user->department->name }} </a>
                                </div>
                                <a> {{ $user->background }} </a>
                                <div class="row g-0 mt-4">
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-phone me-2"></i>
                                            {{ $user->contact }}</a>
                                    </div>
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-envelope me-2"></i>
                                            {{ $user->email }}</a>
                                    </div>
                                </div>
                                <div class="row g-0 mt-2">
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-birthday-cake me-2"></i>
                                            {{ $user->birthdate }}</a>
                                    </div>
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-home me-2"></i>
                                            {{ $user->address }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-end">
                                <div class="text-end">
                                    <a href="{{ route('update_employee', ['id' => $user->id]) }}" class="text-decoration-none text-white">
                                        <i class="fa fa-pencil mt-3"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row custom-dark-purple mt-3">
                            <div class="col-6">
                                <h5 class="py-3">@lang('public.personal_information')</h5>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.ic_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->ic_number }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.gender')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">
                                            @switch($user->gender)
                                                @case(\App\Models\User::GENDER_MALE)
                                                    @lang('public.male')
                                                    @break
                                                @case(\App\Models\User::GENDER_FEMALE)
                                                    @lang('public.female')
                                                    @break
                                                @default
                                                    @lang('public.male')
                                            @endswitch
                                        </a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.nationality')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">
                                            @if($user->nationality)
                                                @lang('public.malaysian')
                                            @else
                                                @lang('public.foreign')
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.race')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">
                                            @switch($user->race)
                                                @case(\App\Models\User::RACE_CHINESE)
                                                    @lang('public.chinese')
                                                    @break
                                                @case(\App\Models\User::RACE_MALAY)
                                                    @lang('public.malay')
                                                    @break
                                                @case(\App\Models\User::RACE_INDIAN)
                                                    @lang('public.indian')
                                                    @break
                                                @case(\App\Models\User::RACE_OTHER)
                                                    @lang('public.others')
                                                    @break
                                                @default
                                                    @lang('public.chinese')
                                            @endswitch
                                        </a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.marital_status')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">
                                            @switch($user->maritial_status)
                                                @case(\App\Models\User::MARITIAL_STATUS_SINGLE)
                                                    @lang('public.single')
                                                    @break
                                                @case(\App\Models\User::MARITIAL_STATUS_MARRIED)
                                                    @lang('public.married')
                                                    @break
                                                @case(\App\Models\User::MARITIAL_STATUS_DIVORCED)
                                                    @lang('public.divorced')
                                                    @break
                                                @case(\App\Models\User::MARITIAL_STATUS_WIDOWED)
                                                    @lang('public.widowed')
                                                    @break
                                                @default
                                                    @lang('public.single')
                                            @endswitch
                                        </a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.emergency_contact')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->emergency_contact }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.relationship')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->emergency_contact_relationship }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <h5 class="py-3">@lang('public.financial_information')</h5>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.bank_name')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->bank_name }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.bank_account_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->bank_account_number }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.epf_account_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->epf_account_number }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.socso_account_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->socso_account_number }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.income_tax_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->income_tax_number }}</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row custom-dark-purple mt-3">
                            <h5 class="py-3">@lang('public.company_informations')</h5>

                            <div class="col-6">
                                    <div class="row my-3">
                                        <div class="col-6">
                                            @lang('public.user_password')
                                        </div>
                                        <div class="col-6">
                                            <a class="text-secondary text-decoration-none">123456</a>
                                        </div>
                                    </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.employment_type')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">
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
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.basic_salary')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ number_format($user->salary, 2) }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.joining_date')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">{{ $user->joining_date }}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.agreement_of_offer_letter')
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ asset('uploads/users/offer_letter/'.$user->offer_letter_attachment ) }}" download> {{$user->offer_letter_attachment}}</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.agreement_of_permanent')
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ asset('uploads/users/permanent_attachment/'.$user->permanent_attachment ) }}" download> {{$user->permanent_attachment}}</a>
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
