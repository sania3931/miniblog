@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="pageheader-title">@lang('pageheader.tableCategory')</h2>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>@lang('titlecard.listCategory')</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ url('Admin/categories') }}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                @method('post')
                                @csrf
                                <div class="row row-form">
                                    <div class="col-12">
                                        <label class=" form-control-label">@lang('form.addParentCategory')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="name" name="name" placeholder="@lang('table.categoryName')"
                                            class="form-control mb-3 @error('name') is-invalid @enderror" required
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="hidden" name="is_parent" value="1">
                                        <input type="hidden" name="cat_parent_id" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit">@lang('button.save')</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ url('Admin/categories') }}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                @method('post')
                                @csrf
                                <div class="row row-form">
                                    <div class="col-12">
                                        <label class="form-control-label">@lang('form.addCategory')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="@lang('table.categoryName')" required value="{{ old('name') }}">
                                        <input type="hidden" name="is_parent" value="0">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <select name="cat_parent_id" id="select" class="form-control">
                                            <option value="" hidden>@lang('form.categoryParent')</option>
                                            @foreach ($category->where('is_parent', '1') as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit">@lang('button.save')</button>
                                    </div>
                                </div>
                            </form>
                            <!-- DATA TABLE-->
                            {{-- <a href="{{ url('admin/categories') }}" type="button" class="btn btn-primary mb-3">Add</a> --}}
                            <div class="table-responsive m-t-40">
                                <table class="table table-bordered table-data3" id="category">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>@lang('table.categoryName')</th>
                                            <th>@lang('table.categoryParent')</th>
                                            <th>@lang('table.action')</th>

                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                @foreach ($category as $cate)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $cate->name}}</td>

                                        <td>{{ $cate->parent->name ?? 'parent'}}</td>
                                        <td>
                                            <form id="form-delete-{{ $cate->id}}" method="post" action="{{ url('Admin/categories/'.$cate->id) }}">
                                                <button type="button" class="btn btn-success btn-sm btn-edit" data-id="{{$cate->id}}">@lang('button.edit')</button>
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-delete btn btn-danger btn-sm " value="{{ $cate->id}}">@lang('button.delete')</button>

                                            </form>
                                        </td>
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
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div> --}}
                </div>
            </div>
        </div>
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
            aria-hidden="true" style="z-index: 999999">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">

                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                var locale = "{{ Config::get('app.locale') }}"
                if (locale == 'id') {
                    var table = $('#category').DataTable({
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                        },
                        processing: true,
                        serverSide: true,
                        searching: true,
                        ajax: {
                            url: "{{ url('Admin/categories/showCategories') }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }
                    });
                } else {
                    var table = $('#category').DataTable({
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json',
                        },
                        processing: true,
                        serverSide: true,
                        searching: true,
                        ajax: {
                            url: "{{ url('Admin/categories/showCategories') }}",
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}"
                            }
                        }
                    });
                }
            })
            // $('.btn-delete').click(function(e) {
            //     e.preventDefault();
            //     var id = $(this).val()
            //     Swal.fire({
            //         title: '@lang('alert.areYouSure?')',
            //         text: "@lang('alert.youWillDeleteThisData!')",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: '@lang('alert.yesDeleteIt')',
            //         cancelButtonText: '@lang('alert.noCancelIt')',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $('#form-delete-' + id).submit()
            //             Swal.fire(
            //                 '@lang('alert.deleted')',
            //                 '@lang('alert.yourFileHasBeenDeleted')',
            //                 '@lang('alert.success')'
            //             )
            //         }
            //     })
            // });

            function btnEdit(id) {
                // console.log(id);
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/categories/${id}/edit') }}`,
                    cache: false,
                    success: function(response) {
                        $('.modal-content').html(response);
                        $('#mediumModal').modal('show');
                        $('.modal-backdrop').hide()
                    }
                })
            }

            function saveData(id) {
                var data = new FormData($('#form-edit-category')[0])
                $.ajax({
                    type: "POST",
                    url: `{{ url('Admin/categories/${id}') }}`,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    success: function(response) {
                        $('#form-edit-category').trigger('reset')
                        $('#mediumModal').modal('hide');
                        table.draw();
                    }
                });
            }

            // $('.btn-edit').click(function (e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     console.log(id);
            //     $.ajax({
            //         type: "GET",
            //         url: `{{ url('Admin/categories/${id}/edit') }}`,
            //         cache: false,
            //         success: function (response) {
            //             $('.modal-content').html(response);
            //             $('#mediumModal').modal('show');
            //             $('.modal-backdrop').hide()
            //         }
            //     })

            // });
            function destroyCategories(id) {
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
                            url: "{{ route('deleteCategories') }}",
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
                                        'success'
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
            // function editCategories(id) {
            //     $.ajax({
            //         type: "GET",
            //         url: `{{ url('Admin/categories/${id}/edit') }}`,
            //         cache: false,
            //         success: function (response) {
            //             $('.modal-content').html(response);
            //             $('#mediumModal').modal('show');
            //             $('.modal-backdrop').hide()
            //         }
            //     })
        </script>
    @endsection
