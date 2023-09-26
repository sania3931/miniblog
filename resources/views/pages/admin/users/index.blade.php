@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="pageheader-title">@lang('pageheader.tableUser')</h2>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <a href="{{ url('Admin/users/create') }}" type="button" class="btn btn-primary mb-3">
                        @lang('button.add')</a>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3" id="user">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>@lang('table.name')</th>
                                    <th>@lang('table.email')</th>
                                    <th>@lang('table.phone')</th>
                                    <th>@lang('table.role')</th>
                                    <th>@lang('table.action')</th>

                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($user as $userss)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userss->name }}</td>
                                        <td>{{ $userss->email }}</td>
                                        <td>{{ $userss->phone }}</td>
                                        <td>{{ $userss->role }}</td>
                                        <td> --}}
                            {{-- <button type="button" action="{{ url('admin/users/'.$userss->id )}}" class="btn btn-success btn-sm mb-1 btn-edit" data-id="{{$userss->id}}">Edit</button> --}}
                            {{-- <form id="form-delete-{{ $userss->id }}" method="post"
                                                action="{{ url('Admin/users/' . $userss->id) }}">
                                                <a href="{{ route('users.edit', $userss->email) }}"
                                                    class="btn btn-success btn-sm">@lang('button.edit')</a>
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-delete btn btn-danger btn-sm "
                                                    value="{{ $userss->id }}">@lang('button.delete')</button>

                                            </form> --}}
                            {{-- <button class="btn btn-danger">Delete</button> --}}
                            {{-- </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a
                                href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var locale = "{{ Config::get('app.locale') }}"
            if (locale == 'id') {
                var table = $('#user').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ url('Admin/users/showUser') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                });
            } else {
                var table = $('#user').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ url('Admin/users/showUser') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                });
            }
        })

        function destroyUser(id) {
            Swal.fire({
                title: '@lang('alert.areYouSure?')',
                text: "@lang('alert.youWillDeleteThisData!')",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang('alert.yesDeleteIt')',
                cancelButtonText: '@lang('alert.noCancelIt')',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url(Auth::user()->role . '/users/${id}') }}`,
                        type: "post",
                        data: {
                            'id': id,
                            '_method': 'DELETE',
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                    '@lang('alert.deleted')',
                                    '@lang('alert.yourFileHasBeenDeleted')',
                                    '@lang('alert.success')'
                                ).then(function() {
                                    window.location.reload()

                                })
                            } else {
                                Swal.fire(
                                    '{{ __('alert.dataSaved') }}',
                                    '{{ __('alert.dataIsNotDeleted') }}',
                                    'error'
                                ).then(function() {
                                    window.location.reload()
                                })
                            }
                        },
                        error: {

                        }
                    });
                }
            })
        };
    </script>
@endsection
