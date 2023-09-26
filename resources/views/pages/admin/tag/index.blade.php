@extends('templates.admin.main')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="pageheader-title">@lang('pageheader.tableTag')</h2>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>@lang('titlecard.listTag')</strong>
                        </div>
                        <div class="card-body card-block">
                            {{-- <form  id="form-edit-tag" data-parsley-validate class="foem-horizontal form-label-left" action="#" method="post" style="display: none">
                                @method('post')
                                @csrf
                                <div class="row row-form">
                                    <div class="col-12">
                                        <label class=" form-control-label">@lang('form.nameTag')</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <input type="hidden" name="tag_id" value="">
                                        <input type="text" id="name" name="name" placeholder="@lang('table.name')"
                                            class="form-control mb-3 @error('name') is-invalid @enderror" required
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="saveData();">@lang('button.edit')</button>
                                        <a href="{{ url('pages.admin.tag.index') }}" class="btn btn-success">@lang('button.cancel')</a>
                                    </div>
                                </div>

                            </form>
                            @method('post')
                            @csrf --}}
                            {{-- <form action="{{ url('Admin/tag') }}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                @method('post')
                                @csrf
                                <div class="row row-form">
                                    <div class="col-12">
                                        <label class=" form-control-label">@lang('form.nameTag')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="name" name="name" placeholder="@lang('table.name')"
                                            class="form-control mb-3 @error('name') is-invalid @enderror" required
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-sm" type="submit">@lang('button.save')</button>
                                    </div>
                                </div>
                            </form> --}}
                            <!-- DATA TABLE-->
                            {{-- <a href="{{ url('Admin/tag/create') }}" type="button" class="btn btn-primary mb-3"> @lang('button.add')</a> --}}
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3" id="tag">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>@lang('table.name')</th>
                                            <th>@lang('table.slug')</th>
                                            <th>@lang('table.action')</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                @foreach ($tags as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td>

                                            <form id="form-delete-{{ $row->id }}" method="post"
                                                action="{{ url('Admin/tag/' . $row->id) }}">
                                                <a href="{{ route('tag.edit', $row->name) }}"
                                                    class="btn btn-success btn-sm">@lang('button.edit')</a>
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-delete btn btn-danger btn-sm "
                                                    value="{{ $row->id }}">@lang('button.delete')</button>

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
                </div>
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
        // $(document).ready(function() {
            var locale = "{{ Config::get('app.locale') }}"
            if (locale == 'id') {
                var table = $('#tag').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ url('Admin/tag/showTag') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                });
            } else {
                var table = $('#tag').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ url('Admin/tag/showTag') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                });
            }
        // })

        function btnDestroy(id) {
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
        }

            function btnEditTag(id) {
                // console.log(id);
                // console.log(id);
                $.ajax({
                    type: "GET",
                    url: `{{ url('Admin/tag/${id}/edit') }}`,
                    cache: false,
                    success: function(response) {
                        $('.modal-content').html(response);
                        $('#mediumModal').modal('show');
                        $('.modal-backdrop').hide()
                    }
                })
            }

            function saveData(id) {
                var data = new FormData($('#form-edit-tag')[0])
                $.ajax({
                    type: "POST",
                    url: `{{ url('Admin/tag/${id}')}}`,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            },
                    success: function (response) {
                        $('#form-edit-tag').trigger('reset')
                        $('#mediumModal').modal('hide');
                        table.draw();
                    }
                });
            }

    </script>
@endsection

