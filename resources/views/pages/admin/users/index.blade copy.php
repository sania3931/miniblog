@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <a href="{{ url('Admin/users/create') }}" type="button" class="btn btn-primary mb-3"> @lang('button.add')</a>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3" id="example">
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
                            <tbody>
                                @foreach ($user as $userss)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userss->name }}</td>
                                        <td>{{ $userss->email }}</td>
                                        <td>{{ $userss->phone }}</td>
                                        <td>{{ $userss->role }}</td>
                                        <td>
                                            {{-- <button type="button" action="{{ url('admin/users/'.$userss->id )}}" class="btn btn-success btn-sm mb-1 btn-edit" data-id="{{$userss->id}}">Edit</button> --}}
                                            <form id="form-delete-{{ $userss->id }}" method="post"
                                                action="{{ url('Admin/users/' . $userss->id) }}">
                                                <a href="{{ route('users.edit', $userss->email) }}"
                                                    class="btn btn-success btn-sm">@lang('button.edit')</a>
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-delete btn btn-danger btn-sm "
                                                    value="{{ $userss->id }}">@lang('button.delete')</button>

                                            </form>
                                            {{-- <button class="btn btn-danger">Delete</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                var id = $(this).val()
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
                        $('#form-delete-' + id).submit()
                        Swal.fire(
                            '@lang('alert.deleted')',
                            '@lang('alert.yourFileHasBeenDeleted')',
                            '@lang('alert.success')'
                        )
                    }
                })
            });
        })
    </script>
@endsection
