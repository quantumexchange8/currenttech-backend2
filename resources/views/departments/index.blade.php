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
                        <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center" id="addDepartment"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-add me-3"></i>
                            <span class="w-100">@lang('public.add_department')</span>
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
                                    <th scope="col">@lang('public.department_head')</th>
                                    <th scope="col">@lang('public.department_name')</th>
                                    <th scope="col">@lang('public.no_of_employee')</th>
                                    <th scope="col">@lang('public.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row"> {{$no}}</th>
                                        <td>{{ $record->head ? $record->head->employee_id : '-' }}</td>
                                        <td>{{ $record->head ? $record->head->name : '-' }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->members()->count() }}</td>
                                        <td class="d-table-cell w-auto">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Button Group">
                                                <button type="button" class="btn">
                                                    <i class="fa fa-pencil text-success updateDepartment" id={{$record->id}} data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                                                </button>
                                                <button type="button" class="btn me-1">
                                                    <i class="fa fa-trash text-danger delete_button"  id="{{$record->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                                </button>
                                                <button type="button" class="btn view_button" id="{{$record->id}}" data-bs-toggle="modal"
                                                        data-bs-target="#viewModal">
                                                    <i class="fa fa-eye" style="color: rgba(53, 57, 114, 1)"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                        <?php
                                        $no++;
                                        ?>
                                @endforeach

                                </tbody>
                                @if ($records->hasPages())
                                    <tr>
                                        <td colspan="10" class="pt-3 pb-0">
                                            {!! $records->links('pagination::bootstrap-4') !!}
                                        </td>
                                    </tr>
                                @endif
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

    {{--    modal --}}
    <form method="post" action="{{ route('departments_index') }}" enctype="multipart/form-data">
        @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">                    @lang('public.add_department')
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group w-100">
                                <label for="department_head" class="form-label">@lang('public.department_head')</label>
                                <div class="input-group">
                                    {!! Form::select('department_head', $head_options, @$input->department_head , ['class' => 'form-select department_head', 'placeholder' => trans('public.pick_department_head')]) !!}
                                </div>
                                @error('department_head')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <label for="department_name" class="form-label">@lang('public.department_name')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="department_name" name="department_name"
                                       required="required"
                                       aria-label="Department's username" aria-describedby="basic-addon2"
                                       value="{{ @$input->department_name }}">
                                @error('department_name')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('public.close')</button>
                    <button type="submit" name="submit" value="" class="btn btn-primary form_action_btn">@lang('public.save')</button>
                </div>
            </div>
        </div>
    </div>
    </form>
{{--delete modal--}}
    <form method="post" action="{{ route('department_delete') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                        <div class="d-flex flex-column align-items-center">
                            <h2>
                                <i class="fa fa-trash text-danger fa-2x"></i>
                            </h2>
                            <h2 class="text-center text-white">@lang('public.delete_department')</h2>
                            <h5 class="text-center pt-2 text-secondary">@lang('public.delete_department_message')</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center align-items-center">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" name="submit"  class="btn btn-danger">@lang('public.delete')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{--    view modal--}}

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="viewModalLabel">                    @lang('public.view_details')
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                    <div class="row">
                        <label for="assigned_to" class="form-label department_member_list">@lang('public.department_members')</label>
                        <div id="usersContainer">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let add_text = "@lang('public.add')";
        let add_ann = "@lang('public.add_department')";
        let save_ann = "@lang('public.edit_department')";
        let save_text = "@lang('public.save')";
        let dept_member = "@lang('public.department_members')";
        let no_dept = "@lang('public.no_department_member')";


        $(document).ready(function() {
            @if($errors->any())
            $('#exampleModal').modal('show');
            @endif

            $('.delete_button').on('click', function() {
                let id = $(this).attr('id');
                $("#deleteModal .modal-body #id").val(id);
            });

            $('#addDepartment').click(function () {
                $(".form_action_btn").text(add_text).val('add');
                $("#exampleModal .modal-title").text(add_ann);
            });

            // Handle Delete button click
            $('.updateDepartment').click(function () {
                $(".form_action_btn").text(save_text).val('update');
                $("#exampleModal .modal-title").text(save_ann);
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route("get_department_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function (response) {
                        $("#exampleModal .modal-body #id").val(response.id);
                        $("#exampleModal .modal-body .department_head").val(response.department_head_id);
                        $("#exampleModal .modal-body #department_name").val(response.name);
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occur during the request
                        console.error(error);
                    }
                });
            });

            $('.view_button').on('click', function() {
                let id = $(this).attr('id');

                $.ajax({
                    url: '{{ route("get_department_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        let usersContainer = $('#usersContainer');
                        usersContainer.empty();
                        console.log(response.members);
                        if (response.members.length === 0) {
                            $('.department_member_list').text(no_dept);
                        } else {
                            $('.department_member_list').text(dept_member);
                        }
                        $.each(response.members, function(index, item) {
                            var newDiv = $('<div>').addClass('text-white pt-2').text(item.name);
                            usersContainer.append(newDiv);
                        });

                    },
                    error: function(xhr, status, error) {
                        // Handle any errors that occur during the request
                        console.error(error);
                    }
                });

            });
        });
    </script>
@endsection

