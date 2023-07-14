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
                <form method="post" action="{{ $submit }}" enctype="multipart/form-data">
                    @csrf
                <div class="row justify-content-center mt-3">
                        <div class="row custom-dark-purple mt-3">
                            <h4 class="py-3">@lang('public.personal_information')</h4>
                            <div class="row my-3">
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="employee_name" class="form-label">@lang('public.employee_name')</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="employee_name" name="employee_name"
                                                   required="required"
                                                   aria-label="Department's username" aria-describedby="basic-addon2"
                                                   value="{{ @$input->employee_name }}">
                                        </div>
                                        @error('employee_name')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">

                                </div>
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="ic_number" class="form-label">@lang('public.ic_number')</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="ic_number" name="ic_number"
                                                   required="required"
                                                   aria-label="ic_number" aria-describedby="basic-addon2"
                                                   value="{{ @$input->ic_number }}">
                                        </div>
                                        @error('ic_number')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="gender" class="form-label">@lang('public.gender')</label>
                                        <div class="input-group">
                                            {!! Form::select('gender', $list_gender, @$input->gender , ['class' => 'form-select ', 'placeholder' => trans('public.pick_gender')]) !!}
                                        </div>
                                        @error('gender')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="birth_date" class="form-label">@lang('public.birth_date')</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="birth_date" name="birth_date"
                                                   required="required"
                                                   aria-label="birth_date" aria-describedby="basic-addon2"
                                                   value="{{ @$input->birth_date }}">

                                        </div>
                                        @error('birth_date')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="nationality" class="form-label">@lang('public.nationality')</label>
                                        <div class="input-group">
                                            {!! Form::select('nationality', $list_nationality, @$input->nationality , ['class' => 'form-select ', 'placeholder' => trans('public.pick_nationality')]) !!}
                                        </div>
                                        @error('nationality')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-5">

                                    <div class="form-group w-100">
                                        <label for="passport_foreigner" class="form-label">@lang('public.passport_foreigner')</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="passport_foreigner" name="passport_foreigner"

                                                   aria-label="passport_foreigner" aria-describedby="basic-addon2"
                                                   value="{{ @$input->passport_foreigner }}">

                                        </div>
                                        @error('passport_foreigner')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="race" class="form-label">@lang('public.race')</label>
                                        <div class="input-group">
                                            {!! Form::select('race', $list_race, @$input->race , ['class' => 'form-select ', 'placeholder' => trans('public.pick_race')]) !!}
                                        </div>
                                        @error('race')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-5">
                                    <div class="form-group w-100">
                                        <label for="marital_status" class="form-label">@lang('public.marital_status')</label>
                                        <div class="input-group">
                                            {!! Form::select('marital_status', $list_maritial_status, @$input->marital_status , ['class' => 'form-select ', 'placeholder' => trans('public.pick_marital_status')]) !!}
                                        </div>
                                        @error('marital_status')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="row custom-dark-purple mt-3">
                        <h4 class="py-3">@lang('public.contact_information')</h4>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="phone_number" class="form-label">@lang('public.phone_number')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                               required="required"
                                               aria-label="phone_number" aria-describedby="basic-addon2"
                                               value="{{ @$input->phone_number }}">

                                    </div>
                                    @error('phone_number')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="email_address" class="form-label">@lang('public.email_address')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email_address" name="email_address"

                                               aria-label="ic_number" aria-describedby="basic-addon2"
                                               value="{{ @$input->email_address }}">

                                    </div>
                                    @error('email_address')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="emergency_contact" class="form-label">@lang('public.emergency_contact')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact"
                                               required="required"
                                               aria-label="emergency_contact" aria-describedby="basic-addon2"
                                               value="{{ @$input->emergency_contact }}">

                                    </div>
                                    @error('emergency_contact')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="relationship" class="form-label">@lang('public.relationship')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="relationship" name="relationship"
                                               required="required"
                                               aria-label="relationship" aria-describedby="basic-addon2"
                                               value="{{ @$input->relationship }}">

                                    </div>
                                    @error('relationship')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-group w-100">
                                    <label for="home_address" class="form-label">@lang('public.home_address')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="home_address" name="home_address"
                                               required="required"
                                               aria-label="home_address" aria-describedby="basic-addon2"
                                               value="{{ @$input->home_address }}">

                                    </div>
                                    @error('home_address')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="row custom-dark-purple mt-3">
                        <h4 class="py-3">@lang('public.employee_background')</h4>
                        <div class="row my-3">
                            <div class="col">
                                <div class="form-group w-100">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="employee_background" name="employee_background"
                                               required="required"
                                               aria-label="employee_background" aria-describedby="basic-addon2"
                                               value="{{ @$input->employee_background }}" style="min-height: 50px;">

                                    </div>
                                    @error('employee_background')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="row custom-dark-purple mt-3">
                        <h4 class="py-3">@lang('public.financial_information')</h4>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="bank_name" class="form-label">@lang('public.bank_name')</label>
                                    <div class="input-group">
                                        {!! Form::select('bank_name', $list_banks, @$input->bank_name , ['class' => 'form-select ', 'placeholder' => trans('public.pick_bank_name')]) !!}
                                    </div>
                                    @error('bank_name')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="bank_account_number" class="form-label">@lang('public.bank_account_number')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="bank_account_number" name="bank_account_number"
                                               required="required"
                                               aria-label="bank_account_number" aria-describedby="basic-addon2"
                                               value="{{ @$input->bank_account_number }}">

                                    </div>
                                    @error('bank_account_number')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="epf_account_number" class="form-label">@lang('public.epf_account_number')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="epf_account_number" name="epf_account_number"
                                               required="required"
                                               aria-label="epf_account_number" aria-describedby="basic-addon2"
                                               value="{{ @$input->epf_account_number }}">

                                    </div>
                                    @error('epf_account_number')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="socso_account_number" class="form-label">@lang('public.socso_account_number')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="socso_account_number" name="socso_account_number"
                                               required="required"
                                               aria-label="socso_account_number" aria-describedby="basic-addon2"
                                               value="{{ @$input->socso_account_number }}">

                                    </div>
                                    @error('socso_account_number')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="income_tax_number" class="form-label">@lang('public.income_tax_number')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="income_tax_number" name="income_tax_number"
                                               required="required"
                                               aria-label="income_tax_number" aria-describedby="basic-addon2"
                                               value="{{ @$input->income_tax_number }}">

                                    </div>
                                    @error('income_tax_number')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="row custom-dark-purple mt-3">
                        <h4 class="py-3">@lang('public.company_informations')</h4>
                        <div class="row my-3">
                            <div class="col-5">

                                <div class="form-group w-100">
                                    <label for="employee_id" class="form-label">@lang('public.employee_id')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="employee_id" name="employee_id"
                                               required="required"
                                               aria-label="employee_id" aria-describedby="basic-addon2"
                                               value="{{ @$input->employee_id }}">

                                    </div>
                                    @error('employee_id')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">

                                <div class="form-group w-100">
                                    <label for="user_password" class="form-label">@lang('public.user_password')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="user_password" name="user_password"
                                               aria-label="user_password" aria-describedby="basic-addon2"
                                               value="{{ @$input->user_password }}">

                                    </div>
                                    @error('user_password')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="department" class="form-label">@lang('public.department')</label>
                                    <div class="input-group">
                                        {!! Form::select('department', $list_departments, @$input->department , ['class' => 'form-select ', 'placeholder' => trans('public.pick_department')]) !!}
                                    </div>
                                    @error('department')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="designation" class="form-label">@lang('public.designation')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="designation" name="designation"
                                               required="required"
                                               aria-label="designation" aria-describedby="basic-addon2"
                                               value="{{ @$input->designation }}">

                                    </div>
                                    @error('designation')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="employment_type" class="form-label">@lang('public.employment_type')</label>
                                    <div class="input-group">
                                        {!! Form::select('employment_type', $list_employment_type, @$input->employment_type , ['class' => 'form-select ', 'placeholder' => trans('public.pick_employment_type')]) !!}
                                    </div>
                                    @error('employment_type')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="basic_salary" class="form-label">@lang('public.basic_salary')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="basic_salary" name="basic_salary"
                                               required="required"
                                               aria-label="basic_salary" aria-describedby="basic-addon2"
                                               value="{{ @$input->basic_salary }}">

                                    </div>
                                    @error('basic_salary')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="joining_date" class="form-label">@lang('public.joining_date')</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="joining_date" name="joining_date"
                                               required="required"
                                               aria-label="joining_date" aria-describedby="basic-addon2"
                                               value="{{ @$input->joining_date }}">

                                    </div>
                                    @error('joining_date')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="agreement_of_offer_letter" class="form-label">@lang('public.agreement_of_offer_letter')</label>
                                    @if(!empty($input->agreement_of_offer_letter))
                                        <a href="{{ asset('uploads/users/offer_letter/'.$input->agreement_of_offer_letter ) }}" download>Download Offer Letter Attachment</a>
                                    @endif
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="agreement_of_offer_letter" name="agreement_of_offer_letter"
                                               aria-label="agreement_of_offer_letter" aria-describedby="basic-addon2"
                                               value="{{ @$input->agreement_of_offer_letter }}">

                                    </div>
                                    @error('agreement_of_offer_letter')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <div class="form-group w-100">
                                    <label for="agreement_of_permanent" class="form-label">@lang('public.agreement_of_permanent')</label>
                                    @if(!empty($input->agreement_of_permanent))
                                        <a href="{{ asset('uploads/users/permanent_attachment/'.$input->agreement_of_permanent ) }}" download>Permanent Attachment</a>
                                    @endif
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="agreement_of_permanent" name="agreement_of_permanent"
                                               aria-label="agreement_of_permanent" aria-describedby="basic-addon2"
                                               value="{{ @$input->agreement_of_permanent }}">

                                    </div>
                                    @error('agreement_of_permanent')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-3">

                    <button type="submit" class="btn btn-primary w-25 text-center mb-4">
                        @lang('public.save')
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
