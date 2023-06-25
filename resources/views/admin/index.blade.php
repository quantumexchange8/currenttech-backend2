@extends('layouts.master')

@section('title',  $title )

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
                        <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center"
                                id="addAdmin"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-add me-3"></i>
                            <span class="w-100">@lang('public.add_admin')</span>
                        </button>
                    </div>
                    <div class="col-11">
                        @if($records->isNotEmpty())
                                <?php
                                $no = $records->firstItem();
                                ?>
                            <table class="table table-purple text-center">
                                <thead>
                                <tr class="text-secondary  text-uppercase">
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('public.employee_id')</th>
                                    <th scope="col">@lang('public.name')</th>
                                    <th scope="col">@lang('public.email')</th>
                                    <th scope="col">@lang('public.role')</th>
                                    <th scope="col">@lang('public.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row"> {{$no}}</th>
                                        <td>{{$record->employee_id}}</td>
                                        <td>{{$record->name}}</td>
                                        <td>{{$record->email}}</td>
                                        <td>
                                            @switch($record->admin_type)
                                                @case(\App\Models\User::TYPE_ADMIN)
                                                    @lang('public.super_admin')
                                                    @break
                                                @case(\App\Models\User::TYPE_SUBADMIN)
                                                    @lang('public.sub_admin')
                                                    @break
                                                @default
                                                    @lang('public.super_admin')
                                            @endswitch
                                        </td>
                                        <td class="d-table-cell w-auto">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Button Group">
                                                <button type="button" class="btn updateAdmin" id="{{$record->id}}"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="fa fa-pencil text-success"></i>
                                                </button>

                                                <button type="button" class="btn me-1">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </button>
                                                <button type="button" class="btn">
                                                    <a href="{{ route('admin_detail', ['id' => $record->id]) }}"  style="color: rgba(53, 57, 114, 1)">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </button>
                                            </div>
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

    <form method="post" id="submit_form" action="{{ route('admin_index') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalLabel">                    @lang('public.add_department')

                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group w-100">
                                    <label for="admin_id" class="form-label">@lang('public.admin_id')</label>
                                    <div class="input-group swap_input">
                                        {!! Form::select('admin_id', $admin_options, @$input->admin_id , ['class' => 'form-select ', 'id' => 'admin_id', 'placeholder' => trans('public.pick_employee')]) !!}
                                    </div>
                                    @error('admin_id')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="admin_role" class="form-label">@lang('public.department_name')</label>
                                <div class="input-group">
                                    {!! Form::select('admin_role', $admin_roles, @$input->admin_role , ['class' => 'form-select ', 'id' => 'admin_role', 'placeholder' => trans('public.pick_role')]) !!}
                                    @error('admin_role')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" class="btn btn-primary">@lang('public.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            @if($errors->any())
            $('#exampleModal').modal('show');
            @endif

            $('#addAdmin').click(function () {
                $('#submit_form').attr('action', '{{ route('admin_index') }}');
                $('.swap_input').html('{!! Form::select('admin_id', $admin_options, @$input->admin_id , ['class' => 'form-select ', 'id' => 'admin_id', 'placeholder' => trans('public.pick_employee')]) !!}');
            });

            // Handle Delete button click
            $('.updateAdmin').click(function () {
                $('#submit_form').attr('action', '{{ route('admin_index') }}');

                $('.swap_input').html('<input type="text" class="form-control" id="admin_id" name="admin_id" required="required" aria-label="admin_id" aria-describedby="basic-addon2" readonly value="{{ @$input->admin_id }}">');
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route("get_user_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function (response) {
                        let adminType = response.admin_type;

                        $(".modal-body #admin_id").val(response.name);

                        $(".modal-body #admin_role").val(adminType);
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occur during the request
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
