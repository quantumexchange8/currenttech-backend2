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
                <div id="loading-spinner" class="spinner-border text-primary" role="status" style="display: none;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="row justify-content-center">

                    @foreach ($permissions as $chunk)
                        <div class="col-md-5 mt-3 bg-dark-blue mx-2">
                        @foreach ($chunk as $item)
                                <div class="form-check form-switch py-2">
                                    <label class="form-check-label" for="toggleSwitch{{ $item }}">{{ $item }}</label>
                                    <input class="form-check-input toggle-switch" type="checkbox" role="switch" id="toggleSwitch{{ $item }}" data-value="{{ $item }}"
                                           @if (in_array($item, $user_permissions)) checked @endif
                                    />
                                </div>
                        @endforeach
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        let user = @json($user);
        $(document).ready(function () {
            $('.toggle-switch').on('click', function() {
                let value = $(this).data('value');
                let isChecked = $(this).is(':checked');
                let type;

                if (isChecked) {
                    type = 'give';
                } else {
                    type = 'revoke';
                }

                $.ajax({
                    url: '{{ route("update_permissions", ":id") }}'.replace(':id', user.id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        permission: value,
                        type: type,
                    },
                    success: function(response) {
                        // Handle the response from the server
                        console.log(response);
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
