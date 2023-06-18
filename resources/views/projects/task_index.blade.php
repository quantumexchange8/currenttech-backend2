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

                    <div class="col-11 d-flex justify-content-end mt-3">
                        <button class="btn btn-primary d-flex justify-content-center align-items-center me-3"   id="addProject"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-add me-2"></i>
                            <span class="w-100">@lang('public.create_task')</span>
                        </button>


                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
                            <label id="monthly" class="btn btn-outline-primary" for="btnradio1" data-value="all">@lang('public.all')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                            <label class="btn btn-outline-primary" for="btnradio2" data-value="1">@lang('public.planned')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                            <label class="btn btn-outline-primary" for="btnradio3" data-value="2">@lang('public.in_progress')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                            <label class="btn btn-outline-primary" for="btnradio4" data-value="3">@lang('public.in_progress')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio5">
                            <label class="btn btn-outline-primary" for="btnradio5" data-value="4">@lang('public.completed')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio6">
                            <label class="btn btn-outline-primary" for="btnradio6" data-value="5">@lang('public.overdue')</label>
                        </div>
                    </div>
                    <div class="col-11 d-flex justify-content-start my-3">
                        <form method="post" id="filter_form" action="{{ route('tasks_index') }}">
                            @csrf
                            <div class="row">
                                <input type="hidden" id="filter_status" name="filter_status">
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
                                    <button class="btn btn-primary submit_form_button mt-4 mx-0" type="submit" name="submit" value="search">@lang('public.search')</button>
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
                            <tr>
                                <td colspan="10">
                                    <div class="row justify-content-start pt-1 pb-2">
                                        <div class="col-auto">
                                            <a><i class="fa fa-info-circle text-primary fa-lg me-2"></i>@lang('public.planned')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-search text-secondary fa-lg me-2"></i>@lang('public.in_progress')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-check-circle text-success fa-lg me-2"></i>@lang('public.completed')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-check-circle text-success fa-lg me-2"></i>@lang('public.completed')</a>
                                        </div>
                                        <div class="col-auto">
                                            <a><i class="fa fa-exclamation-circle text-danger fa-lg me-2"></i>@lang('public.overdue')</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-secondary text-uppercase">
                                <th scope="col">#</th>
                                <th scope="col">@lang('public.project_name')</th>
                                <th scope="col">@lang('public.project_category')</th>
                                <th scope="col">@lang('public.task_name')</th>
                                <th scope="col">@lang('public.created_by')</th>
                                <th scope="col">@lang('public.due_date')</th>
                                <th scope="col">@lang('public.status')</th>
                                <th scope="col">@lang('public.action')</th>
                            </tr>
                            </thead>
                            @foreach($records as $record)
                            <tbody>
                            <tr>
                                <th scope="row">{{$no}}</th>
                                <td>{{$record->project->name}}</td>
                                <td>{{$record->project->getType()}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->user->name}}</td>
                                <td>{{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}</td>
                                <td>
                                    <a><i class="{{$record->getStatus()['class']}}"></i></a>
                                </td>
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
                                    <?php
                                    $no++;
                                    ?>
                            @endforeach
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

    <form method="post" id="submit_form" action="{{ route('tasks_index') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalLabel">                    @lang('public.add_announcement')

                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                        <div class="row">
                            <div class="col">
                                <label for="project_name"
                                       class="form-label">@lang('public.project_name')</label>
                                <div class="input-group">
                                    {!! Form::select('project_name', $projects, @$input->project_name , ['class' => 'form-select', 'id' => 'project_name', 'placeholder' => trans('public.pick_project_name')]) !!}
                                </div>
                                @error('project_name')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="task_name" class="form-label">@lang('public.task_name')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="task_name" name="task_name"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->task_name }}">
                                </div>
                                @error('task_name')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>


                        </div>
                        <div class="row mt-2">
                            <label for="task_description"
                                   class="form-label">@lang('public.task_description')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="task_description"
                                       name="task_description"
                                       required="required"
                                       aria-label="Department's username" aria-describedby="basic-addon2"
                                       value="{{ @$input->task_description }}">
                            </div>
                            @error('task_description')
                            <div>
                                <p class="pt-2 text-danger">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="due_date"
                                       class="form-label">@lang('public.due_date')</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="due_date"
                                           name="due_date"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->due_date }}">

                                </div>
                                @error('due_date')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="notification_sent"
                                       class="form-label">@lang('public.notification_sent')</label>
                                <div class="input-group">
                                    {!! Form::select('notification_sent', $notifications, @$input->notification_sent , ['class' => 'form-select', 'id' => 'notification_sent', 'placeholder' => trans('public.pick_notification_sent')]) !!}
                                </div>
                                @error('notification_sent')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="assigned_to" class="form-label">@lang('public.assigned_to')</label>
                            <div id="usersContainer">
                                <label>
                                    <input type="hidden" name="assigned_to[]">
                                </label>

                            </div>

                            @error('assigned_to')
                            <div>
                                <p class="pt-2 text-danger">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" class="btn btn-primary form_action_btn" name="submit" value="create">@lang('public.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        let add_text = "@lang('public.create')";
        let add_ann = "@lang('public.create_task')";
        let save_ann = "@lang('public.edit_project')";
        let save_text = "@lang('public.save')";
        $(document).ready(function () {
            @if($errors->any())
            $('#exampleModal').modal('show');
            @endif


            $('#project_name').on('change', function() {
                let selectedOption = $(this).val();

                // Make the API call with the selected option
                if (selectedOption !== '') {
                    $.ajax({
                        url: '{{ route("get_project_data", ":id") }}'.replace(':id', selectedOption),
                        type: 'GET',
                        success: function (response) {


                            var users = response;
                            var usersContainer = $('#usersContainer');

                            // Clear any existing content in the container
                            usersContainer.empty();

                            // Loop through the retrieved users and append the content to the container
                            $.each(users, function(index, user) {
                                var checkbox = $('<input>').attr({
                                    type: 'checkbox',
                                    name: 'assigned_to[]',
                                    value: user.id
                                });

                                var label = $('<label>').append(checkbox);

                                var div = $('<div>').addClass('input-group').append(
                                    label,
                                    $('<div>').addClass('ps-2').text(user.name)
                                );

                                usersContainer.append(div);
                            });
                        },
                        error: function (xhr, status, error) {
                            // Handle any errors that occur during the request
                            console.error(error);
                        }
                    });
                }
            });

            $('#addProject').click(function () {
                $('#submit_form').attr('action', '{{ route('tasks_index') }}');
                $(".form_action_btn").text(add_text);
                $(".modal-title").text(add_ann);

            });

            // Handle Delete button click
            $('.updateAnnouncement').click(function () {
                $('#submit_form').attr('action', '{{ route('update_announcement') }}');
                $(".form_action_btn").text(save_text);
                $(".modal-title").text(save_ann);
                {{--let id = $(this).attr('id');--}}
                {{--$.ajax({--}}
                {{--    url: '{{ route("get_announcement_data", ":id") }}'.replace(':id', id),--}}
                {{--    type: 'GET',--}}
                {{--    success: function (response) {--}}
                {{--        $(".modal-body #id").val(response.id);--}}
                {{--        $(".modal-body #title").val(response.title);--}}
                {{--        $(".modal-body #post_date").val(response.post_date);--}}
                {{--        $(".modal-body #expiration_date").val(response.expiration_date);--}}
                {{--        $(".modal-body #announcement_category").val(response.category);--}}
                {{--        $(".modal-body #message").val(response.messages);--}}
                {{--        if (response.participation === 1) {--}}
                {{--            // Code to execute if the condition is true--}}
                {{--            $(".modal-body #require_participation").prop("checked", true);--}}
                {{--        } else {--}}
                {{--            $(".modal-body #require_participation").prop("checked", false);--}}
                {{--        }--}}
                {{--        if (response.attachment) {--}}
                {{--            $('.swap_input a').attr('href', '{{ asset('uploads/announcements') }}' + '/' + response.attachment).show();--}}
                {{--        } else {--}}
                {{--            $('.swap_input').hide();--}}
                {{--        }--}}

                {{--    },--}}
                {{--    error: function (xhr, status, error) {--}}
                {{--        // Handle any errors that occur during the request--}}
                {{--        console.error(error);--}}
                {{--    }--}}
                {{--});--}}
            });
        });
    </script>
@endsection
