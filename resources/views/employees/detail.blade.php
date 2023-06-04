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
                                        <a>@lang('public.employee_id'): 123456</a>
                                        <a>position</a>
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
                                    Jasmine Lee
                                </h5>
                                <div class="my-2 me-3">
                                    <a class="bg-success text-decoration-none text-dark px-2 py-1 rounded">Management
                                        Department</a>
                                </div>
                                <a>Graduated with Bsc (Hons) of Psycology from UTAR. 4 years working experience as admin
                                    assistant in ZZZ company. 5 years working experience as HR admin in XXX company.
                                    Awarded best employee in the company. Participated in YYY Competition 2012 and got
                                    champion. </a>
                                <div class="row g-0 mt-4">
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-phone me-2"></i>
                                            0162218806</a>
                                    </div>
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-envelope me-2"></i>
                                            admin.support@gmail.com</a>
                                    </div>
                                </div>
                                <div class="row g-0 mt-2">
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-birthday-cake me-2"></i>
                                            19/11/2022</a>
                                    </div>
                                    <div class="col-6 d-flex justify-content-start">
                                        <a class="text-decoration-none text-white">
                                            <i class="fa fa-home me-2"></i>
                                            No.23, Jalan Desa, Taman Desa Aman, 45600, Selangor.</a>
                                    </div>
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
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.gender')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.nationality')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.race')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.marital_status')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.emergency_contact')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.relationship')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
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
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.bank_account_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.epf_account_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.socso_account_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.income_tax_number')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row custom-dark-purple mt-3">
                            <h5 class="py-3">@lang('public.company_informations')</h5>

                            <div class="col-6">
                                    <div class="row my-3">
                                        <div class="col-6">
                                            @lang('public.created_on')
                                        </div>
                                        <div class="col-6">
                                            <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                        </div>
                                    </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.user_password')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.basic_salary')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.joining_date')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.agreement_of_offer_letter')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        @lang('public.agreement_of_permanent')
                                    </div>
                                    <div class="col-6">
                                        <a class="text-secondary text-decoration-none">11 Oct 2022</a>
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
