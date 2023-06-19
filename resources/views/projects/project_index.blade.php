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
                        <button class="btn btn-primary d-flex justify-content-center align-items-center me-3"
                                id="addProject"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-add me-2"></i>
                            <span class="w-100">@lang('public.create_project')</span>
                        </button>


                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
                            <label id="monthly" class="btn btn-outline-primary"
                                   for="btnradio1">@lang('public.all')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                            <label class="btn btn-outline-primary" for="btnradio3">@lang('public.in_progress')</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                            <label class="btn btn-outline-primary" for="btnradio4">@lang('public.completed')</label>

                        </div>
                    </div>
                    <div class="col-11">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @foreach($records as $record)
                                <div class="col">
                                    <div class="card custom-dark-purple  p-3">
                                        <div class="row g-0">
                                            <div class="col-11">
                                                <h5 class="card-title" href="#">
                                                    <a href="{{ route('project_details', $record->id) }}"
                                                       class="text-white"> {{$record->name}} </a>
                                                </h5>

                                            </div>
                                            <div class="col-1">
                                                <div class="mt-2">
                                                    <a class="nav-link" id="notificationsDropdown" href="#"
                                                       role="button"
                                                       data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="text-white fas fa-ellipsis-v"></i> </a>

                                                    <ul class="dropdown-menu dropdown-menu-end custom-dark-purple text-white"
                                                        aria-labelledby="notificationsDropdown">
                                                        <li><a class="dropdown-item delete_button text-danger"   id="{{$record->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal">@lang('public.delete')</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-0 mt-2">
                                            <div class="col-6">

                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <div class="mt-2 me-3">
                                                    @switch($record->category)
                                                        @case(\App\Models\Projects::CATEGORY_NEW)
                                                            <a class="text-decoration-none text-dark px-2 rounded"
                                                               style="background-color: rgba(168, 215, 224, 1)">

                                                                {{ __('public.new') }}
                                                            </a>

                                                            @break

                                                        @case(\App\Models\Projects::CATEGORY_ENHANCEMENT)
                                                            <a class="text-decoration-none text-dark px-2 rounded"
                                                               style="background-color: rgba(189, 189, 189, 1)">

                                                                {{ __('public.enhancement') }}
                                                            </a>

                                                            @break

                                                        @case(\App\Models\Projects::CATEGORY_MODIFICATION)
                                                            <a class="text-decoration-none text-dark px-2 rounded"
                                                               style="background-color: rgba(160, 217, 180, 1)">

                                                                {{ __('public.modification') }}
                                                            </a>

                                                            @break

                                                        @default
                                                            <a class="text-decoration-none text-dark px-2 rounded"
                                                               style="background-color: rgba(255, 226, 140, 1)">

                                                                {{ __('public.technical_issue') }}
                                                            </a>

                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-0 mt-4">
                                            <div class="col-6 d-flex justify-content-start">
                                                <a class="text-decoration-none text-white">
                                                    <i class="fa fa-hourglass me-2"></i>
                                                    {{$record->duration()}} @lang('public.days')</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-start">
                                                <a class="text-decoration-none text-white">
                                                    <i class="fa fa-spinner me-2"></i>
                                                    {{$record->getLevel()}}</a>
                                            </div>
                                        </div>
                                        <div class="row g-0 mt-2">
                                            <div class="col-6 d-flex justify-content-start">
                                                <a class="text-decoration-none text-white">
                                                    <i class="fa fa-file-text me-2"></i>
                                                    {{$record->attachments()->count()}} @lang('public.attachments')</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-start">
                                                <a class="text-decoration-none text-white">
                                                    <i class="fa fa-tasks me-2"></i>
                                                    0 @lang('public.tasks')</a>
                                            </div>
                                        </div>
                                        <div class="row g-0 mt-4">
                                            <div class="col-6">
                                                <a class="text-decoration-none text-white"> @lang('public.progress'): 0%</a>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <div class="mt-2 me-3">
                                                    <a class="bg-pink text-decoration-none text-dark px-2 rounded">{{$record->deadline()}} @lang('public.days_left')
                                                        </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-0 mt-2">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning  w-50" role="progressbar"
                                                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form method="post" id="submit_form" action="{{ route('projects_index') }}" enctype="multipart/form-data">
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
                                <label for="project_name" class="form-label">@lang('public.project_name')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="project_name" name="project_name"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->project_name }}">
                                </div>
                                @error('project_name')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="project_category"
                                       class="form-label">@lang('public.project_category')</label>
                                <div class="input-group">
                                    {!! Form::select('project_category', $categories, @$input->project_category , ['class' => 'form-select', 'id' => 'project_category', 'placeholder' => trans('public.pick_project_category')]) !!}
                                </div>
                            </div>
                            @error('project_category')
                            <div>
                                <p class="pt-2 text-danger">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="row mt-2">
                            <label for="project_description"
                                   class="form-label">@lang('public.project_description')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="project_description"
                                       name="project_description"
                                       required="required"
                                       aria-label="Department's username" aria-describedby="basic-addon2"
                                       value="{{ @$input->project_description }}">
                            </div>
                            @error('project_description')
                            <div>
                                <p class="pt-2 text-danger">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="row mt-2">
                            <label for="project_information"
                                   class="form-label">@lang('public.project_information')</label>
                            <div class="swap_input">

                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="project_information"
                                       name="project_information[]"
                                       aria-label="project_information" aria-describedby="basic-addon2"
                                        multiple>
                            </div>
                            @error('project_information')
                            <div>
                                <p class="pt-2 text-danger">{{ $message }}</p>
                            </div>
                            @enderror

                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="project_start_date"
                                       class="form-label">@lang('public.project_start_date')</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="project_start_date"
                                           name="project_start_date"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->project_start_date }}">

                                </div>
                                @error('project_start_date')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="project_end_date"
                                       class="form-label">@lang('public.project_end_date')</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="project_end_date"
                                           name="project_end_date"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->project_end_date }}">
                                </div>
                                @error('project_end_date')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="priority" class="form-label">@lang('public.priority')</label>
                                <div class="input-group">
                                    {!! Form::select('priority', $priorities, @$input->priority , ['class' => 'form-select', 'id' => 'priority', 'placeholder' => trans('public.pick_priority')]) !!}
                                </div>
                                @error('priority')
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

                            @foreach($users as $key => $value)
                                <div class="input-group">

                                    <label>
                                        <input type="checkbox" name="assigned_to[]" value="{{$key}}">
                                    </label>
                                    <div class="ps-2">
                                        {{$value}}
                                    </div>
                                </div>
                            @endforeach


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
                        <button type="submit" class="btn btn-primary form_action_btn">@lang('public.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{--    delete modal--}}
    <form method="post" action="{{ route('project_delete') }}" enctype="multipart/form-data">
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
                            <h2 class="text-center text-white">@lang('public.delete_announcement')</h2>
                            <h5 class="text-center pt-2 text-secondary">@lang('public.delete_announcement_message')</h5>
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
@endsection
@section('script')
    <script>
        let add_text = "@lang('public.create')";
        let add_ann = "@lang('public.create_project')";
        let save_ann = "@lang('public.edit_project')";
        let save_text = "@lang('public.save')";
        $(document).ready(function () {
            @if($errors->any())
            $('#exampleModal').modal('show');
            @endif
            $('.delete_button').on('click', function() {
                let id = $(this).attr('id');
                $("#deleteModal .modal-body #id").val(id);
            });


            $('#addProject').click(function () {
                $('#submit_form').attr('action', '{{ route('projects_index') }}');
                $(".form_action_btn").text(add_text);
                $(".modal-title").text(add_ann);
                $(".modal-body #id").val("");
                $(".modal-body #project_name").val("");
                $(".modal-body #project_category").val("");
                $(".modal-body #project_description").val("");
                $(".modal-body #project_information").val("");
                $(".modal-body #project_start_date").val("");
                $(".modal-body #project_end_date").val("");
                $(".modal-body #priority").val("");
                $(".modal-body #notification_sent").val("");
                $(".modal-body #assigned_to").prop("checked", false);
                $('.modal-body input[name="assigned_to[]"]').prop('checked', false);
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
