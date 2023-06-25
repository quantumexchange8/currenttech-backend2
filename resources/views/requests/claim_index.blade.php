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
                    <div class="col-11 d-flex justify-content-start my-3">
                        <form method="post" action="{{ route('claims_index') }}">
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
                                        @lang('public.date')
                                        <input type="date" class="form-control" id="start_date" name="start_date"  value="{{ @$search['start_date'] }}">
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label for="end_date" class="form-label">
                                        @lang('public.amount')
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
                                <tr class="text-secondary text-uppercase">
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('public.employee_id')</th>
                                    <th scope="col">@lang('public.name')</th>
                                    <th scope="col">@lang('public.claim_type')</th>
                                    <th scope="col">@lang('public.date')</th>
                                    <th scope="col">@lang('public.merchant_name')</th>
                                    <th scope="col">@lang('public.amount')</th>
                                    <th scope="col">@lang('public.status')</th>
                                    <th scope="col">@lang('public.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <th scope="row">{{$no}}</th>
                                    <td>{{$record->user->employee_id}}</td>
                                    <td>{{$record->user->name}}</td>
                                    <td>{{$record->getClaimType()}}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}</td>
                                    <td>{{$record->merchant}}</td>
                                    <td>{{$record->amount}}</td>
                                    <td class="{{$record->getStatus()['class']}}">{{$record->getStatus()['text']}}</td>
                                    <td class="d-table-cell w-auto">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Button Group">
                                            @if($record->checkPendingStatus())
                                                <button type="button" class="btn approve_button" id="{{$record->id}}"  data-bs-toggle="modal"
                                                        data-bs-target="#approveModal">
                                                    <i class="fa fa-check rounded-circle border border-success p-1 text-success"></i>
                                                </button>
                                                <button type="button"  class="btn reject_button" id="{{$record->id}}" data-bs-toggle="modal"
                                                        data-bs-target="#rejectModal">
                                                    <i class="fa fa-times rounded-circle border border-danger p-1 text-danger"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn " id="{{$record->id}}"  >
                                                    <i class="fa fa-check rounded-circle border border-secondary p-1 text-secondary"></i>
                                                </button>
                                                <button type="button"  class="btn reject_button" id="{{$record->id}}" >
                                                    <i class="fa fa-times rounded-circle border border-secondary p-1 text-secondary"></i>
                                                </button>
                                            @endif

                                            <button type="button" class="btn view_button" id="{{$record->id}}" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal">
                                                <i class="fa fa-eye rounded-circle border  p-1" style="color: rgba(53, 57, 114, 1)"></i>
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

    {{--    approve modal--}}
    <form method="post" action="{{ route('claims_index') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                        <div class="d-flex flex-column align-items-center">
                            <h2>
                                <i class="fa fa-exclamation text-white"></i>
                            </h2>
                            <h2 class="text-center text-white">@lang('public.confirmation_message')</h2>
                            <h5 class="text-center pt-2 text-secondary">@lang('public.revert_message')</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center align-items-center">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" name="submit" value="approve" class="btn btn-primary">@lang('public.confirm')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{--    reject modal--}}
    <form method="post" action="{{ route('claims_index') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="rejectModalLabel">                    @lang('public.reject_leave')
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="{{ @$input->id }}">
                        <div class="row">
                            <label for="decline_reason" class="form-label">@lang('public.decline_reason')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="decline_reason" name="decline_reason"
                                       required="required"
                                       aria-label="decline_reason" aria-describedby="basic-addon2"
                                       value="{{ @$input->decline_reason }}">
                            </div>
                            @error('decline_reason')
                            <div>
                                <p class="pt-2 text-danger">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">@lang('public.close')</button>
                        <button type="submit" name="submit" value="reject" class="btn btn-primary">@lang('public.confirm')</button>
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
                        <div class="col">
                            <label for="employee_name" class="form-label">@lang('public.employee_name')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="employee_name" name="employee_name"
                                       required="required"
                                       aria-label="employee_name" aria-describedby="basic-addon2"
                                       value="{{ @$input->employee_name }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <label for="claim_type" class="form-label">@lang('public.claim_type')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="claim_type" name="claim_type"
                                       required="required"
                                       aria-label="claim_type" aria-describedby="basic-addon2"
                                       value="{{ @$input->claim_type }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="date" class="form-label">@lang('public.date')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="date" name="date"
                                       required="required"
                                       aria-label="date" aria-describedby="basic-addon2"
                                       value="{{ @$input->date }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <label for="amount" class="form-label">@lang('public.amount')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="amount" name="amount"
                                       required="required"
                                       aria-label="amount" aria-describedby="basic-addon2"
                                       value="{{ @$input->amount }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="claim_description" class="form-label">@lang('public.claim_description')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="claim_description" name="claim_description"
                                       required="required"
                                       aria-label="claim_description" aria-describedby="basic-addon2"
                                       value="{{ @$input->claim_description }}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <label for="merchant_name" class="form-label">@lang('public.merchant_name')</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="merchant_name" name="merchant_name"
                                       required="required"
                                       aria-label="merchant_name" aria-describedby="basic-addon2"
                                       value="{{ @$input->merchant_name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="reason" class="form-label">@lang('public.reason')</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="reason" name="reason"
                                   required="required"
                                   aria-label="reason" aria-describedby="basic-addon2"
                                   value="{{ @$input->reason }}" disabled>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="attachment" class="form-label">@lang('public.attachment')</label>
                        <div class="input-group attachment">
                            <a href="#" download></a>
                        </div>
                    </div>
                    <div class="row mt-2  decline_reason">
                        <label for="decline_reason" class="form-label">@lang('public.decline_reason')</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="decline_reason" name="decline_reason"
                                   required="required"
                                   aria-label="decline_reason" aria-describedby="basic-addon2"
                                   value="{{ @$input->decline_reason }}" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $('.approve_button').on('click', function() {
                let id = $(this).attr('id');
                $("#approveModal .modal-body #id").val(id);
            });

            $('.reject_button').on('click', function() {
                let id = $(this).attr('id');
                $("#rejectModal .modal-body #id").val(id);
            });

            $('.view_button').on('click', function() {
                let id = $(this).attr('id');

                $.ajax({
                    url: '{{ route("get_claim_data", ":id") }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $("#viewModal .modal-body #employee_name").val(response.user.name);
                        $("#viewModal .modal-body #claim_type").val(response.claim_type);
                        $("#viewModal .modal-body #date").val(response.formatted_created_at);
                        $("#viewModal .modal-body #amount").val(response.amount);
                        $("#viewModal .modal-body #claim_description").val(response.description);
                        $("#viewModal .modal-body #merchant_name").val(response.merchant);
                        $("#viewModal .modal-body #reason").val(response.reason);
                        if (response.attachment) {
                            $('.attachment a').attr('href', '{{ asset('uploads/claims') }}' + '/' + response.attachment).text(response.attachment).show();
                        } else {
                            $('.attachment a').removeAttr('href').text('-').show();
                        }
                        if (response.decline_reason) {
                            $("#viewModal .modal-body #decline_reason").val(response.decline_reason);
                            $("#viewModal .modal-body .decline_reason").show();
                        } else {
                            $("#viewModal .modal-body .decline_reason").hide();
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
