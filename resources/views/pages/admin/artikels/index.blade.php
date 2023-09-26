@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="pageheader-title">@lang('pageheader.tableArticle')</h2>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <a href="{{ url(Auth::user()->role . '/artikels/create') }}" type="button"
                        class="btn btn-primary mb-3">@lang('button.add')</a>
                    <div class="table-responsive m-b-40">
                        <table class="table table-bordered table-data3" id="artikel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>@lang('table.title')</th>
                                    <th>@lang('table.article')</th>
                                    <th>@lang('table.date')</th>
                                    <th>@lang('table.user')</th>
                                    <th>@lang('table.status')</th>
                                    <th>@lang('table.action')</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($artikel as $row)
                                @php
                                    if (app()->getlocale() == 'id') {
                                        $slug = $row->slug ? $row->slug : $row->slug_en;
                                    }else {
                                        $slug = $row->slug_en ? $row->slug_en : $row->slug;
                                    }
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if (app()->getlocale() == 'id')
                                            <td>{{ $row->title ??  $row->title_en }}</td>
                                        @else
                                            <td>{{ $row->title_en ?? $row->title }}</td>
                                        @endif
                                        @if (app()->getlocale() == 'id')
                                            <td>{!! substr($row->content ?? $row->content_en, 0, 100) !!}</td>
                                        @else
                                            <td>{!! substr($row->content_en ?? $row->content, 0, 100) !!}</td>
                                        @endif
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success">@lang('table.publish')</span>
                                            @else
                                                <span class="badge badge-info">@lang('table.draft')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url(Auth::user()->role . '/artikels/' . $slug . '/edit') }}"
                                                class="btn btn-success mb-1 btn-sm">@lang('button.edit')</a>
                                            <form id="form-delete-{{ $row->id }}" method="post"
                                                action="{{ url(Auth::user()->role . '/artikels/' . $row->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-delete btn btn-danger btn-sm "
                                                    value="{{ $row->id }}">@lang('button.delete')</button>
                                                <a href="{{ url(Auth::user()->role . '/artikels/' . $slug) }}"
                                                    class="btn btn-info mt-1 btn-sm">@lang('button.show')</a>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var locale = "{{ Config::get('app.locale') }}"
            if (locale == 'id') {
                $('#artikel').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ url(Auth::user()->role . '/artikels/showArtikel') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                });
            } else {
                $('#artikel').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/en-GB.json',
                    },
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: {
                        url: "{{ url(Auth::user()->role . '/artikels/showArtikel') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                });
            }
        })

        function destroyArticle(id) {
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
                        url: `{{ url(Auth::user()->role . '/artikels/${id}') }}`,
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
