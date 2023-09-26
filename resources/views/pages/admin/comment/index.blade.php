@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="pageheader-title">@lang('pageheader.tableComment')</h2>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>@lang('titlecard.listComment')</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3" id="comment">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>@lang('table.name')</th>
                                            <th>@lang('table.email')</th>
                                            <th>@lang('table.comment')</th>
                                            <th>@lang('table.action')</th>
                                        </tr>
                                    </thead>
                                </table>
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
        var locale = "{{ Config::get('app.locale') }}"
        if (locale == 'id') {
            var table = $('#comment').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                },
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ url('Admin/comment/showComment') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }
            });
        } else {
            var table = $('#comment').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json',
                },
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ url('Admin/comment/showComment') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    }
                }
            });
        }
        function destroyComment(id) {
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
                        url: "{{ route('deleteComment') }}",
                        type: "post",
                        data: {
                            'id': id,
                            '_method': 'DELETE',
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function() {
                            Swal.fire(
                                '@lang('alert.deleted')',
                                '@lang('alert.yourFileHasBeenDeleted')',
                                '@lang('alert.success')'
                            ).then(function() {
                                window.location.reload()

                            })
                        },
                        error: {}
                    })
                }
            })
        };

    </script>
@endsection
