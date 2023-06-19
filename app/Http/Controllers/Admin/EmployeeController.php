<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('employees.index', [
            'title' => trans('public.employee_list'),
            'users' => $users,
        ]);
    }

    public function getData($id)
    {
        $data = User::find($id);

        return response()->json($data);
    }

    public function detail($id = null)
    {
        if ($id) {
            $user = User::find($id);
        } else {
            $user = Auth::user();
        }

        return view('employees.detail', [
            'title' => trans('public.employee_profile'),
            'user' => $user,
        ]);
    }

    public function add(Request $request)
    {
        $validator = null;
        $input = null;

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'employee_name' => 'required',
                'ic_number' => 'required_without_all:passport_foreigner',
                'passport_foreigner' => 'required_without_all:ic_number',
                'gender' => 'required',
                'birth_date' => 'required',
                'nationality' => 'required',
                'race' => 'required',
                'marital_status' => 'required',
                'phone_number' => 'required|unique:users,contact',
                'email_address' => 'required|email|unique:users,email',
                'emergency_contact' => 'required',
                'relationship' => 'required',
                'home_address' => 'required',
                'employee_background' => 'required',
                'bank_name' => 'required',
                'bank_account_number' => 'required',
                'epf_account_number' => 'required',
                'socso_account_number' => 'required',
                'income_tax_number' => 'required',
                'employee_id' => 'required',
                'user_password' => 'required',
                'department' => 'required',
                'designation' => 'required',
                'employment_type' => 'required',
                'basic_salary' => 'required|numeric',
                'joining_date' => 'required|date',
            ]);

            if (!$validator->fails()) {
                $user = User::create([
                    'name' => $request->input('employee_name'),
                    'gender' => $request->input('gender'),
                    'nationality' => $request->input('nationality'),
                    'race' => $request->input('race'),
                    'ic_number' => $request->input('ic_number'),
                    'birthdate' => $request->input('birth_date'),
                    'passport_number' => $request->input('passport_foreigner'),
                    'maritial_status' => $request->input('marital_status'),
                    'contact' => $request->input('phone_number'),
                    'email' => $request->input('email_address'),
                    'address' => $request->input('home_address'),
                    'emergency_contact' => $request->input('emergency_contact'),
                    'emergency_contact_relationship' => $request->input('relationship'),
                    'background' => $request->input('employee_background'),
                    'bank_name' => $request->input('bank_name'),
                    'bank_account_number' => $request->input('bank_account_number'),
                    'epf_account_number' => $request->input('epf_account_number'),
                    'socso_account_number' => $request->input('socso_account_number'),
                    'income_tax_number' => $request->input('income_tax_number'),
                    'employee_id' => $request->input('employee_id'),
                    'password' => Hash::make($request->input('user_password')),
                    'employment_type' => $request->input('employment_type'),
                    'designation' => $request->input('designation'),
                    'salary' => $request->input('basic_salary'),
                    'joining_date' => $request->input('joining_date'),
                    'department_id' => $request->input('department'),
                ]);

                $offer_letter_attachment = $request->file('agreement_of_offer_letter');
                if ($offer_letter_attachment) {
                    if ($user->offer_letter_attachment) {
                        // Delete the previous file if needed
                        File::delete('/uploads/users/offer_letter' . $user->offer_letter_attachment);
                    }
                    $file_offer_letter = time() . '.' . $offer_letter_attachment->getClientOriginalExtension();
                    $offer_letter_attachment->move(public_path('/uploads/users/offer_letter'), $file_offer_letter);
                    $user->offer_letter_attachment = $file_offer_letter;
                }

                $permanent_attachment = $request->file('agreement_of_permanent');
                if ($permanent_attachment) {
                    if ($user->permanent_attachment) {
                        // Delete the previous file if needed
                        File::delete('/uploads/users/permanent_attachment' . $user->permanent_attachment);
                    }
                    $file_permanent_attachment = time() . '.' . $permanent_attachment->getClientOriginalExtension();
                    $permanent_attachment->move(public_path('/uploads/users/permanent_attachment'), $file_permanent_attachment);
                    $user->permanent_attachment = $file_permanent_attachment;
                }
                $user->save();

                Alert::success(trans('public.success'), trans('public.successfully_added_employee'));
                return redirect()->route('add_employee');
            }

            $input = (object)$request->all();
        }

        return view('employees.form', [
            'title' => trans('public.trader_withdrawal'),
            'submit' => route('add_employee'),
            'list_gender' => User::listGender(),
            'list_nationality' => User::listNationality(),
            'list_race' => User::listRace(),
            'list_maritial_status' => User::listMaritialStatus(),
            'list_employment_type' => User::listEmploymentType(),
            'list_departments' => Departments::all()->pluck('name', 'id')->toArray(),
            'list_banks' => User::listBanks(),
            'input' => $input
        ])->withErrors($validator);
    }

    public function update(Request $request, $id)
    {
        $validator = null;
        $user = User::find($id);
        if (!$user) {
            Alert::error(trans('public.invalid_user'), trans('public.try_again'));
            return redirect()->back();
        }

        $input = (object)[
            'employee_name' => $user->name,
            'gender' => $user->gender,
            'nationality' => $user->nationality,
            'race' => $user->race,
            'ic_number' => $user->ic_number,
            'birth_date' => $user->birthdate,
            'passport_foreigner' => $user->passport_number,
            'marital_status' => $user->maritial_status,
            'phone_number' => $user->contact,
            'email_address' => $user->email,
            'home_address' => $user->address,
            'emergency_contact' => $user->emergency_contact,
            'relationship' => $user->emergency_contact_relationship,
            'employee_background' => $user->background,
            'bank_name' => $user->bank_name,
            'bank_account_number' => $user->bank_account_number,
            'epf_account_number' => $user->epf_account_number,
            'socso_account_number' => $user->socso_account_number,
            'income_tax_number' => $user->income_tax_number,
            'employee_id' => $user->employee_id,
            'employment_type' => $user->employment_type,
            'designation' => $user->designation,
            'basic_salary' => $user->salary,
            'joining_date' => $user->joining_date,
            'department' => $user->department_id,
            'agreement_of_offer_letter' => $user->offer_letter_attachment,
            'agreement_of_permanent' => $user->permanent_attachment
        ];

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'employee_name' => 'required',
                'ic_number' => 'required_without_all:passport_foreigner',
                'passport_foreigner' => 'required_without_all:ic_number',
                'gender' => 'required',
                'birth_date' => 'required',
                'nationality' => 'required',
                'race' => 'required',
                'marital_status' => 'required',
                'phone_number' => "required|unique:users,contact,{$user->id},id",
                'email_address' => "required|unique:users,email,{$user->id},id",
                'emergency_contact' => 'required',
                'relationship' => 'required',
                'home_address' => 'required',
                'employee_background' => 'required',
                'bank_name' => 'required',
                'bank_account_number' => 'required',
                'epf_account_number' => 'required',
                'socso_account_number' => 'required',
                'income_tax_number' => 'required',
                'employee_id' => 'required',
                'department' => 'required',
                'designation' => 'required',
                'employment_type' => 'required',
                'basic_salary' => 'required|numeric',
                'joining_date' => 'required|date',

            ]);

            if (!$validator->fails()) {
                $update_info = [
                    'name' => $request->input('employee_name'),
                    'gender' => $request->input('gender'),
                    'nationality' => $request->input('nationality'),
                    'race' => $request->input('race'),
                    'ic_number' => $request->input('ic_number'),
                    'birthdate' => $request->input('birth_date'),
                    'passport_number' => $request->input('passport_foreigner'),
                    'maritial_status' => $request->input('marital_status'),
                    'contact' => $request->input('phone_number'),
                    'email' => $request->input('email_address'),
                    'address' => $request->input('home_address'),
                    'emergency_contact' => $request->input('emergency_contact'),
                    'emergency_contact_relationship' => $request->input('relationship'),
                    'background' => $request->input('employee_background'),
                    'bank_name' => $request->input('bank_name'),
                    'bank_account_number' => $request->input('bank_account_number'),
                    'epf_account_number' => $request->input('epf_account_number'),
                    'socso_account_number' => $request->input('socso_account_number'),
                    'income_tax_number' => $request->input('income_tax_number'),
                    'employee_id' => $request->input('employee_id'),
                    'employment_type' => $request->input('employment_type'),
                    'designation' => $request->input('designation'),
                    'salary' => $request->input('basic_salary'),
                    'joining_date' => $request->input('joining_date'),
                    'department_id' => $request->input('department'),
                ];
                if ($request->input('user_password')) {
                    $update_info['password'] = Hash::make($request->input('user_password'));
                }
                $user->update($update_info);


                $offer_letter_attachment = $request->file('agreement_of_offer_letter');
                if ($offer_letter_attachment) {
                    if ($user->offer_letter_attachment) {
                        // Delete the previous file if needed
                        File::delete('uploads/users/offer_letter.' . $user->offer_letter_attachment);
                    }
                    $file_offer_letter = $user->name . '-offer-letter.' . $offer_letter_attachment->getClientOriginalExtension();
                    $offer_letter_attachment->move(public_path('/uploads/users/offer_letter'), $file_offer_letter);
                    $user->offer_letter_attachment = $file_offer_letter;
                }

                $permanent_attachment = $request->file('agreement_of_permanent');
                if ($permanent_attachment) {
                    if ($user->permanent_attachment) {
                        // Delete the previous file if needed
                        File::delete('uploads/users/permanent_attachment' . $user->permanent_attachment);
                    }
                    $file_permanent_attachment = $user->name . '-permanent.' . $permanent_attachment->getClientOriginalExtension();
                    $permanent_attachment->move(public_path('/uploads/users/permanent_attachment'), $file_permanent_attachment);
                    $user->permanent_attachment = $file_permanent_attachment;
                }

                $user->save();
                $department_head = Departments::where('department_head_id', $user->id)->first();
                if ($department_head) {
                    $department_head->department_head_id = null;
                    $department_head->save();
                }

                Alert::success(trans('public.success'), trans('public.successfully_added_employee'));
                return redirect()->route('update_employee', $user->id);
            }

            $input = (object)$request->all();
        }

        return view('employees.form', [
            'title' => trans('public.trader_withdrawal'),
            'submit' => route('update_employee', $user->id),
            'list_gender' => User::listGender(),
            'list_nationality' => User::listNationality(),
            'list_race' => User::listRace(),
            'list_maritial_status' => User::listMaritialStatus(),
            'list_employment_type' => User::listEmploymentType(),
            'list_departments' => Departments::all()->pluck('name', 'id')->toArray(),
            'list_banks' => User::listBanks(),
            'input' => $input
        ])->withErrors($validator);
    }

    public function update_attitude_punctuality(Request $request)
    {
        $users = User::all();

        $validator = null;
        $input = null;



        if ($request->isMethod('post')) {
            $user = User::find($request->id);
            $validator = Validator::make($request->all(), [
                'attitude' => 'required|numeric|max:100',
                'punctuality' => 'required|numeric|max:100',
            ]);

            if (!$validator->fails()) {
                $update_info = [
                    'attitude' => $request->input('attitude'),
                    'punctuality' => $request->input('punctuality'),
                ];

                $user->update($update_info);

                Alert::success(trans('public.success'), trans('public.successfully_added_employee'));
                return redirect()->route('employees_index');
            }

            $input = (object)$request->all();
        }

        return view('employees.index', [
            'user' => User::listRace(),
            'title' => trans('public.employee_list'),
            'input' => $input,
            'users' => $users,
        ])->withErrors($validator);
    }
}
