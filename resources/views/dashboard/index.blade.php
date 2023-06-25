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
                <div class="row justify-content-center">
                        <div class="col-11 d-flex  justify-content-evenly my-3">
                            <div class="row w-100">
                                <div class="col">
                                    <div class="border border-3 p-3 d-flex align-items-center text-center">
                                        <div class="rounded-circle bg-dark-blue text-white mx-4 d-flex justify-content-center align-items-center " style="width: 60px; height: 60px;">
                                            <i class="fa fa-eye fa-2x "></i>
                                        </div>
                                        <div class="text-center">
                                            <h2>{{$leave_count}}</h2>
                                            <h5 >@lang('public.leave_request')</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border border-3 p-3 d-flex align-items-center text-center">
                                        <div class="rounded-circle bg-dark-blue text-white mx-4 d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <i class="fa fa-bars fa-2x"></i>
                                        </div>
                                        <div class="text-center">
                                            <h2>{{$claim_count}}</h2>
                                            <h5 >@lang('public.claim_request')</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border border-3 p-3 d-flex align-items-center text-center">
                                        <div class="rounded-circle bg-dark-blue text-white mx-4 d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                                            <i class="fa fa-ticket fa-2x"></i>
                                        </div>
                                        <div class="text-center">
                                            <h2>{{$ticket_count}}</h2>
                                            <h5 >@lang('public.employee_ticket')</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-11 d-flex justify-content-start my-3">
                        <form method="post" action="{{ route('dashboard') }}">
                            @csrf
                            <div class="row">
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
                                    <button class="btn btn-primary mt-4 mx-0" type="submit" name="submit" value="search">@lang('public.search')</button>
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
                                                <a><i class="fa fa-times-circle text-danger fa-lg me-2"></i>@lang('public.absent')</a>
                                            </div>
                                            <div class="col-auto">
                                                <a><i class="fa fa-check-circle text-success fa-lg me-2"></i>@lang('public.present')</a>
                                            </div>
                                            <div class="col-auto">
                                                <a><i class="fa fa-clock text-warning fa-lg me-2"></i>@lang('public.late')</a>
                                            </div>
                                            <div class="col-auto">
                                                <a><i class="fa fa-minus-circle text-primary fa-lg me-2"></i>@lang('public.on_leave')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-secondary text-uppercase">
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('public.name')</th>
                                    <th scope="col">@lang('public.date')</th>
                                    <th scope="col">@lang('public.punch_in_time')</th>
                                    <th scope="col">@lang('public.punch_out_time')</th>
                                    <th scope="col">@lang('public.lunch_time')</th>
                                    <th scope="col">@lang('public.rest_time')</th>
                                    <th scope="col">@lang('public.overtime')</th>
                                    <th scope="col">@lang('public.status')</th>
                                    <th scope="col">@lang('public.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <th scope="row">{{$no}}</th>
                                    <td>{{$record->user->name}}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->start_time)->format('H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->end_time)->format('H:i:s') }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="d-table-cell w-auto">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Button Group">
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
                                <div class="flex text-small" role="alert">
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
                        <label for="location" class="form-label">@lang('public.location')</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="location" name="location"
                                   required="required"
                                   aria-label="location" aria-describedby="basic-addon2"
                                   value="{{ @$input->location }}" disabled>
                        </div>
                    </div>
                    <div class="row mt-2  remark">
                        <label for="remark" class="form-label">@lang('public.remark')</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="remark" name="remark"
                                   required="required"
                                   aria-label="remark" aria-describedby="basic-addon2"
                                   value="{{ @$input->remark }}" disabled>
                        </div>
                    </div>
                    <div class="row mt-2  modalImage">
                        <img src="" id="modalImage" class="img-fluid w-100" alt="Modal Image" style="max-height: 600px">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $('.view_button').on('click', function() {
                let id = $(this).attr('id');

                $.ajax({
                    url: '{{ route("get_checkin_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $("#viewModal .modal-body #location").val(response.address);
                        $("#viewModal .modal-body #remark").val(response.remark);
                        if (response.attachment) {
                            $('#modalImage').attr('src',  '{{ asset('uploads/checkins') }}' + '/' + response.attachment);
                            $(".modalImage").show();
                        } else {
                            $('#modalImage').attr('src', '');
                            $(".modalImage").hide();
                        }
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
