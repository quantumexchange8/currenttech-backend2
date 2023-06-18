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
                    <div class="col-7 d-flex flex-column justify-content-start mt-3">
                        <div class="row align-items-center">
                            <h2>{{$record->name}}</h2>
                        </div>
                        <div class="row mb-4 align-items-center">
                            <a class="text-secondary">10 @lang('public.tasks_open') | 5 @lang('public.tasks_complete')</a>
                        </div>
                    </div>
                    <div class="col-4 d-flex justify-content-end my-3">
                        <div class="ms-auto">
                            <button class="btn btn-primary updateProject" id="updateProject"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa fa-add me-2"></i>
                                <span class="w-100">@lang('public.edit_project')</span>
                            </button>

                        </div>
                    </div>
                    <div class="col-11 ">
                        <div class="row g-4 align-items-stretch">
                            <div class="col">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>@lang('public.project_description')</h2>
                                    <p class="text-secondary">{{$record->description}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 align-items-stretch mt-3">
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>@lang('public.project_details')</h2>
                                    <div class="col text-secondary">
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.created_on')</div>
                                                <div> {{date('Y-m-d', strtotime($record->created_at))}}</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.created_by')</div>
                                                <div>{{$record->user->name}}</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.project_start_date')</div>
                                                <div>{{date('Y-m-d', strtotime($record->start_date))}}</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.project_end_date')</div>
                                                <div>{{date('Y-m-d', strtotime($record->end_date))}}</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.priority')</div>
                                                <div>{{$record->getLevel()}}</div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.visual_progress')</div>
                                                <div>15%</div>
                                            </div>
                                            <div class="row g-0 mt-2">
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 15%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="d-flex justify-content-between">
                                                <div>@lang('public.actual_progress')</div>
                                                <div>15%</div>
                                            </div>
                                            <div class="row g-0 mt-2">
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                                         style="width: 15%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <div class="row">
                                        <div class="col-10">
                                            <h2>@lang('public.project_information') </h2>

                                        </div>
                                        <div class="col-2 align-content-center align-items-center">
                                            <span class="input-group-text mt-2 text-white fa fa-add" id="pass_button"  data-bs-toggle="modal" data-bs-target="#exampleModalAttachment"></span>
                                        </div>

                                    </div>

                                    <div class="col">
                                        @foreach($record->attachments as $attachment)
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row g-4 align-items-stretch">
                                                        <div class="col-1 d-flex align-items-center">
                                                            <i class="fa fa-file-text" style="height: 75%;"></i>
                                                        </div>
                                                        <div class="col-6 text-secondary ms-5" >
                                                            <div class="row">
                                                                <a href="{{ asset('uploads/projects/'.$attachment->attachment) }}" download class="text-start">{{$attachment->attachment}}</a>
                                                                <div class="text-start" style="font-size: 11px;">@lang('public.uploaded_by') <span class="text-warning pe-2">{{$attachment->user->name}} </span>{{$attachment->created_at}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                                            <i class="fa fa-trash text-danger text-end"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex flex-column custom-dark-purple h-100 p-3">
                                    <h2>@lang('public.task_assigned')</h2>
                                    <div class="row">
                                        <div class="col text-secondary">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        Default checkbox
                                                    </label>
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label">
                                                        Default checkbox 2
                                                    </label>
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                    <img src="{{ asset('assets/Images/Dashboard_Profile.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form method="post" id="submit_form" action="{{ route('project_details', $record->id) }}" enctype="multipart/form-data">
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
                                <div class="col">
                                    <label for="project_start_date"
                                           class="form-label">@lang('public.project_start_date')</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="project_start_date"
                                               name="project_start_date"
                                               required="required"
                                               aria-label="Department's username" aria-describedby="basic-addon2"
                                               value="{{ @$input->project_start_date }}">
                                        @error('project_start_date')
                                        <div>
                                            <p class="pt-2 text-danger">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
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
                                            <input type="checkbox" name="assigned_to[]" value="{{$key}}"
                                                   @if (in_array($key, $input->assigned_to))
                                                    checked
                                                @endif
                                            >
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


        <form method="post" id="submit_form" action="{{ route('add_attachments', $record->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="exampleModalAttachment" tabindex="-1" aria-labelledby="exampleModalAttachmentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="exampleModalLabel">                    @lang('public.edit_project')

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="project_information"
                                       class="form-label">@lang('public.project_information')</label>
                                <div class="swap_input">

                                </div>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="project_information"
                                           name="project_information[]"
                                           aria-label="project_information" aria-describedby="basic-addon2"
                                           value="{{ @$input->project_information }}" multiple>
                                </div>
                                @error('project_information')
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
                    
                });
            </script>
@endsection
