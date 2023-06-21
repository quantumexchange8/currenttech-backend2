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
                        <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center"
                                id="addAnnouncement"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-add me-3"></i>
                            <span class="w-100">@lang('public.add_announcement')</span>
                        </button>
                    </div>
                    <div class="col-11">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @foreach($records as $record)
                                <div class="col">
                                    <div class="card custom-dark-purple">
                                        <div class="row g-0">
                                            @if($record->attachment)
                                                <div class="col-4">
                                                    <img src="{{ asset('/uploads/announcements/'.$record->attachment) }}" alt="Image" class="img-fluid w-100 h-100">
                                                </div>
                                                <div class="col-7">
                                            @else
                                                        <div class="col-11">
                                            @endif


                                                <div class="card-body">
                                                    <h5 class="card-title">{{$record->title}}</h5>
                                                    <p class="card-text">@lang('public.posted_on') {{$record->post_date}}</p>
                                                    <button class="btn btn-primary d-flex justify-content-center align-items-center w-100 view_button" id="{{$record->id}}" data-bs-toggle="modal"
                                                            data-bs-target="#viewModal">@lang('public.view_details')
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="mt-2">
                                                    <a class="nav-link" id="notificationsDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="text-white fas fa-ellipsis-v"></i> </a>

                                                    <ul class="dropdown-menu dropdown-menu-end custom-dark-purple text-white" aria-labelledby="notificationsDropdown">
                                                        <li>
                                                            <a class="dropdown-item updateAnnouncement" href="#!" id={{$record->id}} data-bs-toggle="modal" data-bs-target="#exampleModal">@lang('public.edit')</a>
                                                        </li>
                                                        <li><a class="dropdown-item delete_button text-danger" id="{{$record->id}}"  data-bs-toggle="modal" data-bs-target="#deleteModal">@lang('public.delete')</a></li>
                                                    </ul>
                                                </div>

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

    <form method="post" id="submit_form" action="{{ route('admin_index') }}" enctype="multipart/form-data">
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
                            <label for="title" class="form-label">@lang('public.title')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="title" name="title"
                                       required="required"
                                       aria-label="Department's username" aria-describedby="basic-addon2"
                                       value="{{ @$input->title }}">
                                @error('title')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="post_date" class="form-label">@lang('public.post_date')</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="post_date" name="post_date"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->post_date }}">
                                    @error('post_date')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <label for="expiration_date" class="form-label">@lang('public.expiration_date')</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                                           required="required"
                                           aria-label="Department's username" aria-describedby="basic-addon2"
                                           value="{{ @$input->expiration_date }}">
                                    @error('expiration_date')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="announcement_category" class="form-label">@lang('public.announcement_category')</label>
                                <div class="input-group">
                                    {!! Form::select('announcement_category', $categories, @$input->announcement_category , ['class' => 'form-select', 'id' => 'announcement_category', 'placeholder' => trans('public.pick_announcement_category')]) !!}
                                </div>
                                @error('announcement_category')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="col">

                                <div class="form-check form-switch mt-5">
                                    <input class="form-check-input" type="checkbox" id="require_participation" name="require_participation">
                                    <label class="form-check-label" for="require_participation" >@lang('public.require_participation')</label>
                                    @error('require_participation')
                                    <div>
                                        <p class="pt-2 text-danger">{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="message" class="form-label">@lang('public.message')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="message" name="message"
                                       required="required"
                                       aria-label="Department's username" aria-describedby="basic-addon2"
                                       value="{{ @$input->message }}">
                                @error('message')
                                <div>
                                    <p class="pt-2 text-danger">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <label for="attachment" class="form-label">@lang('public.attachment')</label>
                            <div class="swap_input">
                                <a href="#" download>Permanent Attachment</a>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="attachment" name="attachment"
                                       aria-label="attachment" aria-describedby="basic-addon2"
                                       value="{{ @$input->attachment }}">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" class="btn btn-primary form_action_btn">@lang('public.delete')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

        {{--    delete modal--}}
        <form method="post" action="{{ route('announcement_delete') }}" enctype="multipart/form-data">
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
                            <button type="submit" name="submit"  class="btn btn-danger">@lang('public.confirm')</button>
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
                            id="viewModalLabel">                    @lang('public.view_activity_details')
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                        <div class="row viewTitle">
                            <h2 class="text-white">Dinner @ sdfsdfds</h2>
                        </div>
                        <div class="row viewDescription">
                            <p class="text-white">Dinner @ sdfsdfds Dinner @  sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfds v sdfsdfds sdfsdfds sdfsdfds sdfsdfds sdfsdfdssdfsdfds sdfsdfds</p>
                        </div>
                        <div class="row mt-2  modalImage">
                            <img src="" id="modalImage" class="img-fluid w-100" alt="Modal Image" style="max-height: 600px">
                        </div>
                        <div class="row member_participation mt-3">
                            <label for="assigned_to" class="form-label">@lang('public.department_members')</label>
                            <div id="usersContainer">

                            </div>
                        </div>
                        <div class="row pt-3 viewPosted">
                            <p class="text-secondary posted_text">Posted by jasmine lee    10/11/2022 11:43:23</p>
                        </div>


                    </div>

                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        let add_text = "@lang('public.add')";
        let add_ann = "@lang('public.add_announcement')";
        let save_ann = "@lang('public.edit_announcement')";
        let save_text = "@lang('public.save')";
        $(document).ready(function () {
            @if($errors->any())
            $('#exampleModal').modal('show');
            @endif

            $('.delete_button').on('click', function() {
                let id = $(this).attr('id');
                $("#deleteModal .modal-body #id").val(id);
            });

            $('#addAnnouncement').click(function () {
                $('#submit_form').attr('action', '{{ route('announcements_index') }}');
                $(".form_action_btn").text(add_text);
                $(".modal-title").text(add_ann);
                $(".modal-body #id").val("");
                $(".modal-body #title").val("");
                $(".modal-body #post_date").val("");
                $(".modal-body #expiration_date").val("");
                $(".modal-body #announcement_category").val("");
                $(".modal-body #message").val("");
                $(".modal-body #require_participation").prop("checked", false);
                $('.swap_input').hide();
            });

            // Handle Delete button click
            $('.updateAnnouncement').click(function () {
                $('#submit_form').attr('action', '{{ route('update_announcement') }}');
                $(".form_action_btn").text(save_text);
                $(".modal-title").text(save_ann);
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route("get_announcement_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function (response) {
                        $(".modal-body #id").val(response.id);
                        $(".modal-body #title").val(response.title);
                        $(".modal-body #post_date").val(response.post_date);
                        $(".modal-body #expiration_date").val(response.expiration_date);
                            $(".modal-body #announcement_category").val(response.category);
                        $(".modal-body #message").val(response.messages);
                        if (response.participation === 1) {
                            // Code to execute if the condition is true
                            $(".modal-body #require_participation").prop("checked", true);
                        } else {
                            $(".modal-body #require_participation").prop("checked", false);
                        }
                        if (response.attachment) {
                            $('.swap_input a').attr('href', '{{ asset('uploads/announcements') }}' + '/' + response.attachment).show();
                        } else {
                            $('.swap_input').hide();
                        }

                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occur during the request
                        console.error(error);
                    }
                });
            });

            $('.view_button').on('click', function() {
                let id = $(this).attr('id');
                $('.viewTitle').empty();
                $('.viewDescription').empty();

                $.ajax({
                    url: '{{ route("get_announcement_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {

                        let user_id = response.user.id;

                        if (response.attachment) {
                            $('#modalImage').attr('src',  '{{ asset('uploads/announcements') }}' + '/' + response.attachment);
                            $(".modalImage").show();
                        } else {
                            $('#modalImage').attr('src', '');
                            $(".modalImage").hide();
                        }
                        $('.viewTitle').append($('<h2>').addClass('text-white').text(response.title));
                        $('.viewDescription').append($('<p>').addClass('text-white').text(response.messages));
                        let routeUrl = '{{ route("employee_detail", ["id" => ":id"]) }}';
                        routeUrl = routeUrl.replace(':id', response.user.id);
                        $('.posted_text').html('@lang("public.posted_by") <a href="' + routeUrl + '">' + response.user.name + '</a> ' + response.created_at);

                        let usersContainer = $('#usersContainer');
                        usersContainer.empty();
                        if (response.members.length === 0) {
                            $('.member_participation').hide();
                        } else {
                            $('.member_participation').show();
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
