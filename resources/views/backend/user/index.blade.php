@extends('backend.layouts.app')
@section('title')
{{ __('All Customers') }}
@endsection
@section('content')
<div class="main-content">
    <div class="page-title">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="title-content">
                        <h2 class="title">{{ __('All Customers') }}</h2>
                        {{-- Add this below <div class="title-content"> {{ route('admin.user.create') }}--}}

                        <a href="" class="title-btn" type="button" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i icon-name="plus-circle"></i>{{ __('Add New User') }}
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="site-card">
                    <div class="site-card-body table-responsive">
                        <div class="site-datatable">
                            <table id="dataTable" class="display data-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Avatar') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Balance') }}</th>
                                        <th>{{ __('Profit') }}</th>
                                        <th>{{ __('KYC') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal for Send Email -->
                @can('customer-mail-send')
                @include('backend.user.include.__mail_send')
                @endcan
                <!-- Modal for Send Email-->
            </div>
        </div>
    </div>
    <!-- Modal for Add New User -->

    @include('backend.user.include.__new_user')

    <!-- Modal for Add New User-->
</div>
@endsection

@section('script')
<script>
    (function($) {
        "use strict";

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.user.index') }}",
            columns: [{
                    data: 'avatar',
                    name: 'avatar'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'balance',
                    name: 'balance'
                },
                {
                    data: 'total_profit',
                    name: 'total_profit',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kyc',
                    name: 'kyc'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            // Add this to ensure tooltips work with DataTables
            drawCallback: function(settings) {
                // Reinitialize tooltips after each table draw
                $('[data-bs-toggle="tooltip"]').tooltip();
                // Reinitialize Lucide icons
                lucide.createIcons();
            }
        });

        // Send mail modal form open
        $(document).on('click', '.send-mail', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            $('#name').html(name);
            $('#userId').val(id);
            $('#sendEmail').modal('toggle');
        });

        // Delete user functionality
        // Update the delete button handler
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var name = $(this).data('name');

            Swal.fire({
                title: '{{ __("Are you sure?") }}',
                text: "{{ __('You are about to delete user:') }} " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("Yes, delete it!") }}',
                cancelButtonText: '{{ __("Cancel") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.user.destroy', '') }}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    '{{ __("Deleted!") }}',
                                    response.message,
                                    'success'
                                );
                                table.ajax.reload(null, false);
                            } else {
                                Swal.fire(
                                    '{{ __("Error!") }}',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            let errorMessage =
                                '{{ __("There was an error deleting the user.") }}';

                            // Try to get server error message
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.statusText) {
                                errorMessage = xhr.statusText;
                            }

                            Swal.fire(
                                '{{ __("Error!") }}',
                                errorMessage,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    })(jQuery);
</script>
@endsection